<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionOptionRequest;
use App\Http\Requests\UpdateQuestionOptionRequest;
use App\Http\Resources\QuestionOptionCollection;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Survey;
use App\Services\QuestionOptionService;
use Illuminate\View\View;

class QuestionOptionController extends Controller
{
    /**
     * Show question options listing.
     */
    public function index(Survey $survey, Question $question, QuestionOptionService $questionOptionService): View
    {
        $questionOptions = $questionOptionService->getQuestionOptionsForListing($question);
        return view('questionOptions.index')->with('question', $question)->with('questionOptions', $questionOptions);
    }

    /**
     * Create question option form.
     */
    public function create(Survey $survey, Question $question): View
    {
        return view('questionOptions.create')->with('question', $question);
    }

    /**
     * Edit question option form.
     */
    public function edit(Survey $survey, Question $question, QuestionOption $questionOption): View
    {
        return view('questionOptions.edit')->with('questionOption', $questionOption)->with('survey', $survey);
    }

    /**
     * Store question option.
     */
    public function store(Question $question, StoreQuestionOptionRequest $request, QuestionOptionService $questionOptionService)
    {
        $questionOption = $questionOptionService->storeQuestionOption($request);
        $alert = $questionOption ? 'Odpowiedź dodana.' : 'Wystąpił błąd.';
        $redirect = $question ? redirect()->route('questionOptionsIndex', [$question->survey_id, $question]) : back()->withInput();
        return $redirect->with('alert', $alert);
    }

    /**
     * Update question option.
     */
    public function update(QuestionOption $questionOption, UpdateQuestionOptionRequest $request, QuestionOptionService $questionOptionService)
    {
        $result = $questionOptionService->updateQuestionOption($questionOption, $request);
        $alert = $result ? 'Odpowiedź zapisana.' : 'Wystąpił błąd.';
        return redirect()->route('questionOptionsIndex', [$questionOption->question->survey_id, $questionOption->question_id])->with('alert', $alert);
    }

    /**
     * Delete question option.
     */
    public function delete(QuestionOption $questionOption, QuestionOptionService $questionOptionService)
    {
        $result = $questionOptionService->deleteQuestionOption($questionOption);
        $alert = $result ? 'Odpowiedź usunięta.' : 'Wystąpił błąd.';
        return redirect()->route('questionOptionsIndex', [$questionOption->question->survey_id, $questionOption->question_id])->with('alert', $alert);
    }

    /**
     * Get question options resource collection.
     */
    public function questionOptionsCollection(Survey $survey, Question $question): QuestionOptionCollection
    {
        return new QuestionOptionCollection($question->options);
    }
}
