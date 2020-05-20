<?php

namespace Tests\Feature;

use App\Models\Consulting;
use App\Models\Consulting\Skill;
use App\Models\Consulting\Specification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ConsultingControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     *
     * Test a user can create a consulting structure
     */
    public function a_user_can_create_a_consulting_structure()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $consulting = factory(Consulting::class)->raw();
        $skills = factory(Skill::class, 3)->create();
        $spec = factory(Specification::class)->raw();
        $categoryId = $skills[1]->category->id;
        $attributes = array_merge([
            'skills' => $skills->pluck('id')->toArray(),
            'specification-' . $categoryId => $spec["content"]
        ], $consulting);

        $this->get(route('consultings.create'))->assertOk()->assertSee('submit');
        $this->post(route('consultings.store', $attributes));

        $created = Consulting::orderByDesc('created_at')->first();

        $this->assertDatabaseHas('consultings', $consulting);
        $this->assertDatabaseHas('consulting_specifications', $spec);
        $this->assertCount(3, $created->skills);
        $this->assertCount(1, $created->specifications);
        $this->assertTrue($user->consultings->contains($created));
    }

    /** @test
     *
     *  When a guest creates a consulting society it stores it in session first.
     *  Then it stores it when the guest logs in or register
     */
    public function guest_store_consulting_in_session()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $skills = factory(Skill::class, 3)->create();
        $attributes = factory(Consulting::class)
            ->raw([
                'skills' => $skills->pluck('id')->toArray(),
                'specifications' => array()
            ]);

        $this->get(route('consultings.create'))->assertOk();
        $this->post(route('consultings.store', $attributes))->assertRedirect(route('login'));
        $this->assertEquals($attributes, Session::get('pending_consulting'));
    }

    /** @test
     *
     *  When a guest submit the creation form it stores the input in session. This function test that it is being
     *  persisted when the guest logs in.
     */
    public function it_creates_the_diagnostic_when_user_logs_in()
    {
        $this->withoutExceptionHandling();
        $credentials = [
            'email' => 'test@test.tld',
            'password' => Hash::make('pass')
        ];
        $user = factory(User::class)->create($credentials);

        $skills = factory(Skill::class, 3)->create();
        $attributes = factory(Consulting::class)
            ->raw([
                'skills' => $skills->pluck('id')->toArray(),
                'specifications' => array()
            ]);

        $this->get(route('consultings.create'))->assertOk();
        $this->post(route('consultings.store', $attributes))->assertRedirect(route('login'));
        $this->actingAs($user)->get(route('landing_page'));

        $created = Consulting::orderByDesc('created_at')->first();
        $this->assertTrue($user->consultings->contains($created));
        $this->assertFalse(Session::has('pending_consulting'));
    }
}
