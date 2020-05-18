<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     *  When a user is logged, it can create a company using a form.
     */
    public function logged_user_can_create_a_company()
    {
        $user = $this->signIn();

        $this->actingAs($user)->get(route('companies.create'))->assertOk()->assertSee('submit');
    }

    /** @test
     *
     *  When a user isn't logged in, he shouldn't be able to create a company
     */
    public function guest_cannot_create_a_company()
    {
        $this->get(route('companies.create'))->assertForbidden();
    }

    /** @test
     *
     *  If a user successfully submit the form it stores the company
     */
    public function a_company_is_stored_when_the_form_is_submitted()
    {
        $user = $this->signIn();
        $company = factory(Company::class)->raw();
        $attributes = array_merge($company, ['cgu' => 'true', 'rgpd' => 'true']);

        $this->actingAs($user)->post(route('companies.store', $attributes))->assertRedirect();

        $this->assertDatabaseHas('companies', $company);
        $this->assertCount(1, $user->companies);
    }
}
