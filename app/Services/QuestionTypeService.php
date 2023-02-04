<?php

namespace App\Services;

use App\Models\QuestionType;
use Illuminate\Database\Eloquent\Collection;

class QuestionTypeService
{
    /**
     * Get all question types.
     */
    public function getQuestionTypes(): Collection
    {
        return QuestionType::all();
    }
}
