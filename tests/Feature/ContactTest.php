<?php

namespace Tests\Feature;

use App\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_send_a_contact_message()
    {
        $this->withoutExceptionHandling();

        $attributes = factory(ContactMessage::class)->raw();

        $this->post(route('contact.store'), $attributes)->assertRedirect(route('landing_page'));
        $this->assertDatabaseHas('contact_messages', $attributes);
    }

    /** @test */
    public function a_user_can_send_a_contact_message_ajax()
    {
        $attributes = factory(ContactMessage::class)->raw();

        $this->post(route('contact.store'), $attributes, [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ])->assertStatus(201);
        $this->assertDatabaseHas('contact_messages', $attributes);
    }
}
