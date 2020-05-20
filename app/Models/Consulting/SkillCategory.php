<?php

namespace App\Models\Consulting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    protected $table = 'consulting_skill_categories';

    public function skills():HasMany
    {
        return $this->hasMany(Skill::class, 'category_id');
    }
}
