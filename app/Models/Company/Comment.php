<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'company_comments';

    /**
     * @return BelongsTo
     */
    public function category():BelongsTo
    {
        return $this->belongsTo(NeedCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function diagnostic():BelongsTo
    {
        return $this->belongsTo(Diagnostic::class);
    }
}
