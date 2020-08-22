<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function diagnostics():BelongsToMany
    {
        return $this->belongsToMany(Diagnostic::class, 'company_diagnostic_need');
    }
}
