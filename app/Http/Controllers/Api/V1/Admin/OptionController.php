<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\OptionRequest;
use App\Http\Resources\Option\OptionResource;
use App\Models\Question;
use App\Services\Admin\OptionService;

/**
 * @group Admin endpoints
 */
class OptionController extends Controller
{
    public function __construct(
        protected OptionService $optionService
    ) {
    }

    /**
     * POST Option
     *
     * Create a option for a question.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function store(Question $question, OptionRequest $request)
    {
        $options = $this->optionService->store($question, $request->validated());

        return new OptionResource($options);
    }
}
