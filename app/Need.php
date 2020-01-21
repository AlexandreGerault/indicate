<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Need extends Model
{
    protected $fillable = ['name', 'category_id'];

    /**
     * Return the need category
     *
     * @return BelongsTo
     */
    public function category():BelongsTo
    {
        return $this->belongsTo(NeedCategory::class);
    }
}
