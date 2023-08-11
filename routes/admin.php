<?php

use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Admin\OptionController;
use App\Http\Controllers\Api\V1\Admin\QuestionController;
use App\Http\Controllers\Api\V1\Admin\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::post('/categories/{category}/quizzes', [QuizController::class, 'store']);
    Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store']);
    Route::post('/questions/{question}/options', [OptionController::class, 'store']);
});
