<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionOptionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Surveys index page
Route::get('/{path?}', [SurveyController::class, 'index'])->name('surveysIndex')->whereIn('path', ['', 'index']);

// Show survey
Route::get('survey/show/{survey}', [SurveyController::class, 'show'])->name('showSurvey')->middleware('surveyCanBeShown');

// Create survey form
Route::get('survey/create', [SurveyController::class, 'create'])->name('createSurvey');

// Edit survey form
Route::get('survey/edit/{survey}', [SurveyController::class, 'edit'])->name('editSurvey');

// Store survey
Route::post('survey/store', [SurveyController::class, 'store'])->name('storeSurvey');

// Update survey
Route::patch('survey/update/{survey}', [SurveyController::class, 'update'])->name('updateSurvey');

// Delete survey
Route::delete('survey/delete/{survey}', [SurveyController::class, 'delete'])->name('deleteSurvey');

// Questions index page
Route::get('/survey/questions/{survey}', [QuestionController::class, 'index'])->name('questionsIndex');

// Create question
Route::get('survey/question-create/{survey}', [QuestionController::class, 'create'])->name('createQuestion');

// Edit question form
Route::get('survey/question-edit/{survey}/{question}', [QuestionController::class, 'edit'])->name('editQuestion')->middleware('questionBelongsToSurvey');

// Store question
Route::post('question/store/{survey}', [QuestionController::class, 'store'])->name('storeQuestion');

// Update question
Route::patch('question/update/{question}', [QuestionController::class, 'update'])->name('updateQuestion');

// Delete question
Route::delete('question/delete/{question}', [QuestionController::class, 'delete'])->name('deleteQuestion');

// Question options index page
Route::get('/survey/question-options/{survey}/{question}', [QuestionOptionController::class, 'index'])->name('questionOptionsIndex')->middleware('questionBelongsToSurvey');

// Create question option
Route::get('survey/question-option-create/{survey}/{question}', [QuestionOptionController::class, 'create'])->name('createQuestionOption')->middleware('questionBelongsToSurvey');

// Edit question option form
Route::get('survey/question-option-edit/{survey}/{question}/{questionOption}', [QuestionOptionController::class, 'edit'])->name('editQuestionOption')->middleware('questionOptionBelongsToQuestion');

// Update question option
Route::patch('questionOption/update/{questionOption}', [QuestionOptionController::class, 'update'])->name('updateQuestionOption');

// Store question option
Route::post('questionOption/store/{question}', [QuestionOptionController::class, 'store'])->name('storeQuestionOption');

// Delete question option
Route::delete('questionOption/delete/{questionOption}', [QuestionOptionController::class, 'delete'])->name('deleteQuestionOption');

// Test method
Route::get('/test', [TestController::class, 'test'])->name('test');
