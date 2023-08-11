<?php

use App\Http\Controllers\Api\V1\AchievementController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\LeaderboardController;
use App\Http\Controllers\Api\V1\QuestionController;
use App\Http\Controllers\Api\V1\QuizController;
use App\Http\Controllers\Api\V1\ResultController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/users', 'store');
    Route::get('/users/{user}', 'show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/users/{user}/update', 'update');
        Route::delete('/users/{user}/delete', 'destroy');
    });
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}/random-quiz', [QuizController::class, 'show']);
Route::get('/quizzes/{quiz:slug}/questions', [QuestionController::class, 'index']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);

Route::controller(ResultController::class)->group(function () {
    Route::post('/results', 'store')->middleware('auth:sanctum');
    Route::get('/results/{user}', 'show');
});

Route::controller(AchievementController::class)->group(function () {
    Route::post('/achievements', 'store')->middleware('auth:sanctum');
    Route::get('/achievements/{user}', 'index');
});
