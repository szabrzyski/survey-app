<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Type associated with question.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class, 'type_id', 'id');
    }

    /**
     * Survey associated with question.
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    /**
     * Options associated with question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    /**
     * Get type name
     */
    public function typeName(): string | null
    {
        return $this->type?->name;
    }
}
