<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NeedCategory extends Model
{
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function needs():HasMany
    {
        return $this->hasMany(Need::class, 'category_id');
    }
}
