<?php

namespace App\Models\Consulting;

use App\Models\Consulting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    protected $table = 'consulting_skills';

    public function category():BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function consultings():BelongsToMany
    {
        return $this->belongsToMany(Consulting::class, 'consulting_skill');
    }
}
