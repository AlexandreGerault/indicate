<?php

namespace Tests\Unit;

use App\Models\Company;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_age()
    {
        $birthDate = Carbon::parse('19-02-1998');
        $now = Carbon::now();
        $user = factory(User::class)->make(['birth_date' => $birthDate]);
        $this->assertEquals($now->diffInYears($birthDate), $user->age);
    }

    /** @test */
    public function it_has_a_full_name()
    {
        $user = factory(User::class)->make(['first_name' => 'John', 'last_name' => 'Doe']);
        $this->assertEquals('John Doe', $user->full_name);
    }

    /** @test
     *
     *  A user can be related to many companies.
     */
    public function it_can_have_companies()
    {
        $user = factory(User::class)->create();
        $companies = factory(Company::class, 3)->create();

        /** @var User $user */
        $user->companies()->attach($companies);

        $this->assertCount(3, $user->companies);
    }
}
