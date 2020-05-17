<?php

namespace App\Models\Company;

use App\Models\Company;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diagnostic extends Model
{
    protected $fillable = [
        'step',
        'uuid',
        'user_id'
    ];

    protected $table = 'company_diagnostics';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param Need[] $needs
     */
    public function addNeeds($needs)
    {
        $this->needs()->attach($needs);
        $this->save();
    }

    /**
     * @param array $comments
     */
    public function addComments($comments)
    {
        foreach ($comments as $key => $content) {
            preg_match('#([0-9]+)$#', $key, $matches);
            $comment = new Comment;
            $comment->content = $content;
            $comment->diagnostic()->associate($this);
            $comment->category()->associate($matches[0]);
            $comment->save();
        }
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function needs(): BelongsToMany
    {
        return $this->belongsToMany(
            Need::class,
            'company_diagnostic_need',
            'diagnostic_id',
            'need_id'
        );
    }

    /**
     * The user that asked the diagnostic
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The company the diagnostic belongs to
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the resource path
     *
     * @return string
     */
    public function path(): string
    {
        return route('company.diagnostics.show', ['diagnostic' => $this], false);
    }

    /**
     * Return a readable status
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return config('status.' . $this->step);
    }

    /**
     * Retrieves the comment for a given category
     *
     * @param $category NeedCategory
     * @return mixed
     */
    public function commentOfCategory(NeedCategory $category)
    {
        return Comment::find(['diagnostic_id' => $this->id, 'category_id' => $category->id])->first();
    }
}
