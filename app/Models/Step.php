<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Step extends Model
{
    public function projects():BelongsToMany {
        return $this->belongsToMany(Project::class);
    }

    public function next():BelongsTo {
        return $this->belongsTo(Step::class);
    }
}
