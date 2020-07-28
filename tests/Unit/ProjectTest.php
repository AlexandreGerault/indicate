<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\ProjectStep;
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

    /** @test */
    public function it_has_a_next_step()
    {
        $project = factory(Project::class)->create();

        $steps = factory(Step::class, 2)->create();
        $steps->first()->next()->associate($steps[1]);
        $steps->first()->save();
        $project->steps()->attach($steps[0]);

        $this->assertInstanceOf(Step::class, $project->steps->first()->next);
    }
}
