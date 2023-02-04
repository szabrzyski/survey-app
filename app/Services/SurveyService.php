<?php

namespace App\Services;

use App\Models\Survey;
use App\Models\SurveyStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SurveyService
{
    /**
     * Get survey for show.
     */
    public function getSurveyForShow($survey): Survey
    {
        return $survey->load('status:id,additional_info', 'questions.options');
    }

    /**
     * Get surveys for listing.
     */
    public function getSurveysForListing(): Collection
    {
        return Survey::with('status:id,name,visible')->get();
    }

    /**
     * Store survey.
     */
    public function storeSurvey(Request $request): Survey | null
    {
        $status = SurveyStatus::where('default', true)->firstOrFail();
        $survey = new Survey();
        $survey->status()->associate($status);
        $survey->name = $request->name;
        return $survey->save() ? $survey : null;
    }

    /**
     * Update survey.
     */
    public function updateSurvey(Survey $survey, Request $request): bool
    {
        $survey->name = $request->name;
        $survey->status_id = $request->status;
        return $survey->save();
    }

    /**
     * Delete survey.
     */
    public function deleteSurvey(Survey $survey): bool
    {
        return $survey->delete();
    }
}
