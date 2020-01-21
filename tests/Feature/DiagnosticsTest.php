<?php

namespace Tests\Feature;

use App\Diagnostic;
use App\Need;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiagnosticsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_store_diagnostic()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $needs = factory(Need::class, 3)->create();

        $attributes = factory(Diagnostic::class)
            ->raw([
                'needs' => array_map(fn($x) => $x['id'], $needs->toArray())
            ]);

        $this->post(route('diagnostics.store'), $attributes);

        $this->get(route('diagnostics.create'))->assertOk();

        $this->assertDatabaseHas('diagnostics', ['user_id' => $user->id]);
    }

    /** @test */
    public function a_user_can_update_a_diagnostic()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $needs = factory(Need::class, 2)->create();

        $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id]);
        $attributes = factory(Diagnostic::class)->raw(['needs' => $needs->pluck('id')->toArray()]);

        $this->patch($diagnostic->path(), $attributes)
            ->assertRedirect($diagnostic->path());
        $this->get($diagnostic->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('diagnostics', ['id' => $diagnostic->id]);
        $this->assertEquals($needs->pluck('id'), $diagnostic->needs->pluck('id'));
    }

    /** @test */
    public function a_user_can_view_a_diagnostic()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id]);

        $this->get($diagnostic->path())->assertOk()->assertSee('diagnostic');
    }

    /** @test */
    public function a_user_can_view_its_diagnostics_list()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $diagnostics = factory(Diagnostic::class, 6)->create(['user_id' => $user->id]);

        $this->get(route('diagnostics.index'))
            ->assertOk()
            ->assertSee('diagnostic');
    }

    /** @test */
    public function a_user_must_own_a_diagnostic_to_update_it()
    {
        $this->signIn();

        $diagnostic = factory(Diagnostic::class)->create();
        $attributes = factory(Diagnostic::class)->raw();

        $this->patch($diagnostic->path(), $attributes)->assertStatus(403);
    }

    /** @test */
    public function a_diagnostic_requires_needs()
    {
        $user = $this->signIn();

        $attributes = factory(Diagnostic::class)->raw(['user_id' => $user->id, 'needs' => []]);

        $this->post(route('diagnostics.store'), $attributes)->assertSessionHasErrors('needs');
        $this->patch(route('diagnostics.update',
            array_merge(
                ['diagnostic' => $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id])->id],
                $attributes
            )))
            ->assertSessionHasErrors('needs');
    }

    /** @test */
    public function a_guest_cannot_manage_diagnostics()
    {
        $diagnostic = factory(Diagnostic::class)->create();

        $this->get(route('diagnostics.create'))->assertStatus(302);
        $this->post(route('diagnostics.store'))->assertStatus(302);
        $this->get(route('diagnostics.show', compact('diagnostic')))->assertStatus(302);
        $this->patch(route('diagnostics.update', compact('diagnostic')))->assertStatus(302);
        $this->get(route('diagnostics.edit', compact('diagnostic')))->assertStatus(302);
    }

    /** @test */
    public function a_user_can_have_diagnostics()
    {
        $user = $this->signIn();
        $diagnostics = factory(Diagnostic::class, 5)->create(['user_id' => $user->id]);

        $this->assertEquals(5, $user->diagnostics->count());
    }

    /** @test */
    public function a_user_must_own_a_diagnostic_to_view_it()
    {
        $user = $this->signIn();
        $diagnostic = factory(Diagnostic::class)->create(['user_id' => factory(User::class)]);

        $this->get(route('diagnostics.show', compact('diagnostic')))->assertStatus(403);
    }
}
