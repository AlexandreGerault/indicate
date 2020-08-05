<?php

namespace App\Listeners;

use App\Events\StepValidated;
use App\Models\Step;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNextStepToProject
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StepValidated  $event
     * @return void
     */
    public function handle(StepValidated $event)
    {
        $last_step = $event->project->steps()->orderByDesc('priority')->first();
        $next_step = Step::orderBy('priority')->where('priority', '>', $last_step->priority)->first();
        $event->project->steps()->attach($next_step->id);
    }
}
