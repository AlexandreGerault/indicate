<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'status',
        'responsible',
        'mail',
        'phone',
        'founded_at'
    ];

    /**
     * @return BelongsToMany
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the resource path
     *
     * @return string
     */
    public function path(): string
    {
        return route('companies.show', ['company' => $this], false);
    }
}
