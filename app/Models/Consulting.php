<?php

namespace App\Models;

use App\Models\Company\Comment;
use App\Models\Company\NeedCategory;
use App\Models\Consulting\Skill;
use App\Models\Consulting\SkillCategory;
use App\Models\Consulting\Specification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consulting extends Model
{
    protected $fillable = [
        'name',
        'responsible',
        'phone',
        'email'
    ];

    /**
     * The skills of the consulting society
     *
     * @return BelongsToMany
     */
    public function skills():BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'consulting_skill', 'consulting_id', 'skill_id');
    }

    /**
     * Some specifications of the consulting society
     *
     * @return HasMany
     */
    public function specifications():HasMany
    {
        return $this->hasMany(Specification::class, 'consulting_id', 'id');
    }

    /**
     * Returns the consulting society's absolute URL
     *
     * @return string
     */
    public function path():string
    {
        return route('consultings.show', $this);
    }

    /**
     * Retrieves the specification for a given category
     *
     * @param $category SkillCategory
     * @return mixed
     */
    public function specificationOfCategory(SkillCategory $category)
    {
        return Specification::where('consulting_id', $this->id)->where('category_id', $category->id)->first();
    }
}
