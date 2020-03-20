<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NeedCategory extends Model
{
    protected $fillable = ['name'];

    protected $table = 'company_need_categories';

    /**
     * @return HasMany
     */
    public function needs():HasMany
    {
        return $this->hasMany(Need::class, 'category_id');
    }
}
