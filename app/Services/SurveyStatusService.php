<?php

namespace App\Services;

use App\Models\SurveyStatus;
use Illuminate\Database\Eloquent\Collection;

class SurveyStatusService
{
    /**
     * Get all survey statuses.
     */
    public function getStatuses(?bool $htmlAvailable = null, ?bool $apiAvailable = null, ?bool $questionsRequired = null): Collection
    {
        return SurveyStatus::when($htmlAvailable !== null, function ($query) use ($htmlAvailable) {
            $query->where('visible', $htmlAvailable);
        })->when($apiAvailable !== null, function ($query) use ($apiAvailable) {
            $query->where('api_available', $apiAvailable);
        })->when($questionsRequired !== null, function ($query) use ($questionsRequired) {
            $query->where('questions_required', $questionsRequired);
        })->get();
    }
}
