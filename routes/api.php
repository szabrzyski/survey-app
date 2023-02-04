<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionOptionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('v1')->group(function () {
    // Get survey details
    Route::get('/survey/{survey}', [SurveyController::class, 'surveyResource'])->name('surveyResource')->middleware('surveyIsApiAvailable');

    // Get questions details
    Route::get('/survey-questions/{survey}', [QuestionController::class, 'questionCollection'])->name('questionCollection');

    // Get question options details
    Route::get('/survey-question-options/{survey}/{question}', [QuestionOptionController::class, 'questionOptionsCollection'])->name('questionOptionsCollection')->middleware('questionBelongsToSurvey');
});
