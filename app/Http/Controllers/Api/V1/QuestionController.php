<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Quiz;
use App\Services\Question\QuestionService;

/**
 * @group Question endpoints
 */
class QuestionController extends Controller
{
    public function __construct(
        protected QuestionService $questionService
    ) {
    }

    /**
     * GET Questions
     *
     * Get questions list by quiz slug
     *
     * @response {"message":"OK"}
     * @response 404 {"message":"Not Found"}
     */
    public function index(Quiz $quiz)
    {
        $questions = $this->questionService->index($quiz);

        return QuestionResource::collection($questions);
    }
}
