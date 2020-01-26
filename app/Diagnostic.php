<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diagnostic extends Model
{
    protected $fillable = [
        'step',
        'uuid',
        'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param Need[] $needs
     */
    public function addNeeds($needs) {
        $this->needs()->attach($needs);
        $this->save();
    }

    /**
     * @return BelongsToMany
     */
    public function needs():BelongsToMany
    {
        return $this->belongsToMany(Need::class);
    }

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resource path
     *
     * @return string
     */
    public function path():string
    {
        return route('diagnostics.show', ['diagnostic' => $this], false);
    }

    /**
     * Return a readable status
     *
     * @return string
     */
    public function getStatusAttribute():string {
        return config('status.' . $this->step);
    }
}
