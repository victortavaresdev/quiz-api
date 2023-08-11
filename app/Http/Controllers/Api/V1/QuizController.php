<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Quiz\QuizService;

/**
 * @group Quiz endpoints
 */
class QuizController extends Controller
{
    public function __construct(
        protected QuizService $quizService
    ) {
    }

    /**
     * GET Quiz
     *
     * Get random quiz by category slug
     *
     * @response {"message":"OK"}
     * @response 404 {"message":"Not Found"}
     */
    public function show(Category $category)
    {
        $randomQuiz = $this->quizService->getRandomQuiz($category);

        return response()->json([
            'data' => $randomQuiz,
        ]);
    }
}
