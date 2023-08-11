<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DTO\Question\QuestionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionRequest;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Quiz;
use App\Services\Admin\QuestionService;

/**
 * @group Admin endpoints
 */
class QuestionController extends Controller
{
    public function __construct(
        protected QuestionService $questionService
    ) {
    }

    /**
     * POST Question
     *
     * Create a question for a quiz.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function store(Quiz $quiz, QuestionRequest $request)
    {
        $dto = QuestionDTO::fromRequest($request);
        $question = $this->questionService->store($quiz, $dto);

        return new QuestionResource($question);
    }
}
