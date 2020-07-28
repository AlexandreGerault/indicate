<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     *
     * Test that an authenticated user can create a project.
     */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $project_attributes = factory(Project::class)->raw();

        $create_response = $this->get(route('projects.create'));
        $store_response = $this->post(route('projects.store'), $project_attributes);
        $created = Project::orderByDesc('created_at')->first();


        $create_response->assertOk();
        $store_response->assertRedirect(route('projects.show', ["project" => $created->id]));
        $this->assertDatabaseHas('projects', $project_attributes);
        $this->assertCount(1, $created->users);
        $this->assertEquals($user->id, $created->users->first()->id);
    }

    /** @test
     *
     * When a user is not authenticated it should not be able to create a project.
     * Then we check we redirect him on the login page.
     */
    public function guest_is_redirected_when_try_to_test()
    {
        $create_response = $this->get(route('projects.create'));
        $store_response = $this->post(route('projects.store'));

        $create_response->assertRedirect(route('login'));
        $store_response->assertRedirect(route('login'));
    }

    /** @test */
    public function a_user_can_show_a_project()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $project = factory(Project::class)->create();
        $project->users()->attach($user);
        $project->save();

        $response = $this->get(route('projects.show', ["project" => $project]));

        $response->assertOk();
    }
}
