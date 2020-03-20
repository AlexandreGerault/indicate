<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Need extends Model
{
    protected $fillable = ['name', 'category_id'];

    protected $table = 'company_needs';

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
