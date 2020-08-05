<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Step;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $expected_name = 'I have a name';
        $project = factory(Project::class)->create(['name' => $expected_name]);
        $this->assertEquals($expected_name, $project->name);
    }

    /** @test */
    public function it_has_contact_information()
    {
        $project = factory(Project::class)->create();

        $this->assertNotNull($project->email);
        $this->assertNotNull($project->phone);
    }

    /** @test */
    public function it_can_belongs_to_users()
    {
        $projects = factory(Project::class, 1)->create()->each(function ($p) {
            $p->users()->saveMany(factory(User::class, 2)->make());
        });

        $this->assertCount(2, $projects->first()->users);
    }

    /** @test */
    public function it_has_steps()
    {
        $project = factory(Project::class)->create();

        $steps = factory(Step::class, 2)->create();
        $project->steps()->attach($steps);

        $this->assertCount(2, $project->steps);
    }

    /** @test
     *
     *  We ensure we at least associate the first step when a project is being created
     */
    public function it_has_a_first_step_when_created()
    {
        $first_step = factory(Step::class)->create(["priority" => 0]);
        $project = factory(Project::class)->create();

        $this->assertCount(1, $project->steps);
        $this->assertEquals($first_step->id, $project->steps->first()->id);
    }

    /** @test */
    public function it_can_validate_last_non_validated_step_and_add_the_next_one()
    {
        factory(Step::class, 2)->create(); //ensure there is at least a second step for the test
        $project = factory(Project::class)->create();

        $first_project_step = $project->steps->first();
        $project->validateLastStep();
        $project->load('steps');


        $this->assertNotNull($project->steps()->where('step_id', $first_project_step->id)->first()->pivot->validated_at);
        $this->assertCount(2, $project->steps);
    }
}
