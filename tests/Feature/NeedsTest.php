<?php

namespace Tests\Feature;

use App\Models\Company\Need;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NeedsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_need()
    {
        $this->withoutExceptionHandling();

        factory(Need::class)->create();

        $this->actingAs($user = factory(User::class)->create())
            ->get(route('company.needs.create'))
            ->assertStatus(200)
            ->assertSee('submit');
    }

    /** @test */
    public function a_user_can_store_a_need()
    {
        $attributes = factory(Need::class)->raw();

        $this->actingAs($user = factory(User::class)->create())
            ->post(route('company.needs.store'), $attributes);

        $this->assertDatabaseHas('company_needs', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_need()
    {
        $need = factory(Need::class)->create();

        $this->actingAs($user = factory(User::class)->create())
            ->get(route('company.need-categories.edit', ['need_category' => $need->category]))
            ->assertStatus(200);
    }

    /** @test */
    public function a_guest_cannot_add_a_need()
    {
        $this->get(route('company.needs.create'))->assertStatus(403);
        $this->post(route('company.needs.store'))->assertStatus(403);
    }

    /** @test */
    public function a_need_requires_a_category()
    {
        $this->expectException(QueryException::class);
        $need = factory(Need::class)->create(['category_id' => null]);
    }
}
