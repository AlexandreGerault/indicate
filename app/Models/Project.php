<?php

namespace App\Models;

use App\Events\StepValidated;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    /**
     * Users related to this project
     *
     * @return BelongsToMany
     */
    public function users():BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    /**
     * Return all the steps, through the ProjectStep model
     *
     * @return BelongsToMany
     */
    public function steps():BelongsToMany {
        return $this->belongsToMany(Step::class)->withPivot('validated_at');
    }

    /**
     * Retrieving all the validated steps
     *
     * @return Collection of steps
     */
    public function validatedSteps():Collection {
        return $this->steps()->wherePivot('validated_at', '!=', null)->get();
    }

    /**
     * Return the non validated step (shall be unique)
     *
     * @return Step
     */
    public function notValidatedStep():Step {
        return $this->steps()->wherePivot('validated_at', '=', null)->first();
    }

    /**
     * Update the validated_at on the pivot table.
     * Fires an event to see if we must add a next step.
     */
    public function validateLastStep():void {
        $this->steps()->updateExistingPivot($this->notValidatedStep(), ['validated_at' => Carbon::now()]);
        $this->save();
        event(new StepValidated($this));
    }
}
