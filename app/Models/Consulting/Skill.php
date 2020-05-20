<?php

namespace App\Models\Consulting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    protected $table = 'consulting_skills';

    public function category():BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }
}
