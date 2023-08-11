<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\QuizRequest;
use App\Http\Resources\Quiz\QuizResource;
use App\Models\Category;
use App\Services\Admin\QuizService;

/**
 * @group Admin endpoints
 */
class QuizController extends Controller
{
    public function __construct(
        protected QuizService $quizService
    ) {
    }

    /**
     * POST Quiz
     *
     * Create a quiz for a category.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function store(Category $category, QuizRequest $request)
    {
        $quiz = $this->quizService->store($category, $request->validated());

        return new QuizResource($quiz);
    }
}
