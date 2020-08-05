<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Step;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $first_step = Step::orderBy('priority')->first();
        $project->steps()->attach($first_step);
        $project->save();
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
