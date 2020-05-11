<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Company\Diagnostic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_diagnostics()
    {
        $company = factory(Company::class)->create();
        $diags = factory(Diagnostic::class, 5)->create(['company_id' => $company->id]);

        $this->assertCount(5, $diags);
    }

    /** @test */
    public function it_can_have_many_users()
    {
        $company = factory(Company::class)->create();
        $users = factory(User::class, 5)->create();

        $company->users()->attach($users);

        $this->assertCount(5, $company->users);
    }
}
