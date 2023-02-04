<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class QuestionService
{
    /**
     * Get questions for listing.
     */
    public function getQuestionsForListing(Survey $survey): Collection
    {
        return $survey->questions()->with('type:id,name')->orderBy('position')->get();
    }

    /**
     * Store question.
     */
    public function storeQuestion(Request $request): Question | null
    {
        $question = new Question();
        $question->survey_id = $request->survey->id;
        $question->type_id = $request->type;
        $question->position = $request->position;
        $question->title = $request->title;
        return $question->save() ? $question : null;
    }

    /**
     * Update question.
     */
    public function updateQuestion(Question $question, Request $request): bool
    {
        $question->type_id = $request->type;
        $question->position = $request->position;
        $question->title = $request->title;
        return $question->save();
    }

    /**
     * Delete question.
     */
    public function deleteQuestion(Question $question): bool
    {
        return $question->delete();
    }
}
