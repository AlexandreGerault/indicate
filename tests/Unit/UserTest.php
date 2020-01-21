<?php

namespace Tests\Unit;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;

class UserTest extends TestCase
{
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
}
