<?php

namespace Tests\Feature;

use App\CompanyDiagnostic;
use App\CompanyNeed;
use App\Models\Company\Diagnostic;
use App\Models\Company\Need;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyDiagnosticsTest extends TestCase
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

        $this->post(route('company.diagnostics.store'), $attributes);
        $this->get(route('company.diagnostics.create'))->assertOk();

        $this->assertDatabaseHas('company_diagnostics', ['user_id' => $user->id]);
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

        $this->assertDatabaseHas('company_diagnostics', ['id' => $diagnostic->id]);
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

        $this->get(route('company.diagnostics.index'))
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

        $this->post(route('company.diagnostics.store'), $attributes)->assertSessionHasErrors('needs');
        $this->patch(route('company.diagnostics.update',
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

        $this->get(route('company.diagnostics.create'))->assertStatus(302);
        $this->post(route('company.diagnostics.store'))->assertStatus(302);
        $this->get(route('company.diagnostics.show', compact('diagnostic')))->assertStatus(302);
        $this->patch(route('company.diagnostics.update', compact('diagnostic')))->assertStatus(302);
        $this->get(route('company.diagnostics.edit', compact('diagnostic')))->assertStatus(302);
    }

    /** @test */
    public function a_user_can_have_diagnostics()
    {
        $user = $this->signIn();
        factory(Diagnostic::class, 5)->create(['user_id' => $user->id]);

        $this->assertEquals(5, $user->diagnostics->count());
    }

    /** @test */
    public function a_user_must_own_a_diagnostic_to_view_it()
    {
        $user = $this->signIn();
        $diagnostic = factory(Diagnostic::class)->create(['user_id' => factory(User::class)]);

        $this->get(route('company.diagnostics.show', compact('diagnostic')))->assertStatus(403);
    }
}
