<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Models\Survey;
use App\Services\SurveyService;
use App\Services\SurveyStatusService;
use Illuminate\View\View;

class SurveyController extends Controller
{
    /**
     * Show survey listing.
     */
    public function index(SurveyService $surveyService): View
    {
        $surveys = $surveyService->getSurveysForListing();
        return view('surveys.index')->with('surveys', $surveys);
    }

    /**
     * Show survey.
     */
    public function show(Survey $survey, SurveyService $surveyService): View
    {
        $survey = $surveyService->getSurveyForShow($survey);
        return view('surveys.show')->with('survey', $survey);
    }

    /**
     * Create survey form.
     */
    public function create(): View
    {
        return view('surveys.create');
    }

    /**
     * Edit survey form.
     */
    public function edit(Survey $survey, SurveyStatusService $surveyStatusService): View
    {
        $surveyStatuses = $surveyStatusService->getStatuses(questionsRequired:$survey->questions()->exists() ? null : false);
        return view('surveys.edit')->with('statuses', $surveyStatuses)->with('survey', $survey);
    }

    /**
     * Store survey.
     */
    public function store(StoreSurveyRequest $request, SurveyService $surveyService)
    {
        $survey = $surveyService->storeSurvey($request);
        $alert = $survey ? 'Badanie dodane.' : 'Wystąpił błąd';
        $redirect = $survey ? redirect()->route('questionsIndex', $survey) : back()->withInput();
        return $redirect->with('alert', $alert);
    }

    /**
     * Update survey.
     */
    public function update(Survey $survey, UpdateSurveyRequest $request, SurveyService $surveyService)
    {
        $result = $surveyService->updateSurvey($survey, $request);
        $alert = $result ? 'Badanie zapisane.' : 'Wystąpił błąd.';
        return redirect()->route('surveysIndex')->with('alert', $alert);
    }

    /**
     * Delete survey.
     */
    public function delete(Survey $survey, SurveyService $surveyService)
    {
        $result = $surveyService->deleteSurvey($survey);
        $alert = $result ? 'Badanie usunięte.' : 'Wystąpił błąd.';
        return redirect()->route('surveysIndex')->with('alert', $alert);
    }

    /**
     * Get survey resource.
     */
    public function surveyResource(Survey $survey): SurveyResource
    {
        return new SurveyResource($survey);
    }
}
