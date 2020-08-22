<?php

namespace App\Models\Consulting;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'consulting_specifications';

    protected $fillable = [
        'category_id',
        'consulting_id',
        'content'
    ];
}
