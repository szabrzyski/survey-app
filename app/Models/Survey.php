<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Questions associated with survey.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'survey_id', 'id');
    }

    /**
     * Status associated with survey.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(SurveyStatus::class, 'status_id', 'id');
    }

    /**
     * Get status name
     */
    public function statusName(): string | null
    {
        return $this->status?->name;
    }
}
