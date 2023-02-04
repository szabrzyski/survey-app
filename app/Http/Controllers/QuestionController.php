<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Models\Question;
use App\Models\Survey;
use App\Services\QuestionService;
use App\Services\QuestionTypeService;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Show question listing.
     */
    public function index(Survey $survey, QuestionService $questionService): View
    {
        $questions = $questionService->getQuestionsForListing($survey);
        return view('questions.index')->with('survey', $survey)->with('questions', $questions);
    }

    /**
     * Create question form.
     */
    public function create(Survey $survey, QuestionTypeService $questionTypeService): View
    {
        $questionTypes = $questionTypeService->getQuestionTypes();
        return view('questions.create')->with('types', $questionTypes)->with('survey', $survey);
    }

    /**
     * Edit question form.
     */
    public function edit(Survey $survey, Question $question, QuestionTypeService $questionTypeService): View
    {
        $questionTypes = $questionTypeService->getQuestionTypes();
        return view('questions.edit')->with('types', $questionTypes)->with('question', $question);
    }

    /**
     * Store question.
     */
    public function store(Survey $survey, StoreQuestionRequest $request, QuestionService $questionService)
    {
        $question = $questionService->storeQuestion($request);
        $alert = $question ? 'Pytanie dodane.' : 'Wystąpił błąd';
        $redirect = $question ? redirect()->route('questionOptionsIndex', [$survey, $question]) : back()->withInput();
        return $redirect->with('alert', $alert);
    }

    /**
     * Update question.
     */
    public function update(Question $question, UpdateQuestionRequest $request, QuestionService $questionService)
    {
        $result = $questionService->updateQuestion($question, $request);
        $alert = $result ? 'Pytanie zapisane.' : 'Wystąpił błąd.';
        return redirect()->route('questionsIndex', $question->survey_id)->with('alert', $alert);
    }

    /**
     * Delete question.
     */
    public function delete(Question $question, QuestionService $questionService)
    {
        $result = $questionService->deleteQuestion($question);
        $alert = $result ? 'Pytanie usunięte.' : 'Wystąpił błąd.';
        return redirect()->route('questionsIndex', $question->survey_id)->with('alert', $alert);
    }

    /**
     * Get survey question resource collection.
     */
    public function questionCollection(Survey $survey): QuestionCollection
    {
        return new QuestionCollection($survey->questions);
    }
}
