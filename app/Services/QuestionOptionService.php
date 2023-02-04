<?php

namespace App\Services;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class QuestionOptionService
{
    /**
     * Get question options for listing.
     */
    public function getQuestionOptionsForListing(Question $question): Collection
    {
        return $question->options()->orderBy('value')->get();
    }

    /**
     * Store question option.
     */
    public function storeQuestionOption(Request $request): QuestionOption | null
    {
        $questionOption = new QuestionOption();
        $questionOption->question_id = $request->question->id;
        $questionOption->value = $request->value;
        $questionOption->title = $request->title;
        return $questionOption->save() ? $questionOption : null;
    }

    /**
     * Update question option.
     */
    public function updateQuestionOption(QuestionOption $questionOption, Request $request): bool
    {
        $questionOption->value = $request->value;
        $questionOption->title = $request->title;
        return $questionOption->save();
    }

    /**
     * Delete question option.
     */
    public function deleteQuestionOption(QuestionOption $questionOption): bool
    {
        return $questionOption->delete();
    }
}
