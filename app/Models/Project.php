<?php

namespace App\Models;

use App\User;
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
        return $this->belongsToMany(Step::class);
    }
}
