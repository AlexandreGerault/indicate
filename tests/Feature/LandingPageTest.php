<?php

namespace Tests\Feature;

use App\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_access_landing_page()
    {
        $this->get(route('landing_page'))
            ->assertSee('title')
            ->assertStatus(200);
    }
}
