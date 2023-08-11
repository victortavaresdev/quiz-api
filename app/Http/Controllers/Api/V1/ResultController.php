<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Result\ResultRequest;
use App\Http\Resources\Result\ResultResource;
use App\Models\User;
use App\Services\Result\ResultService;

/**
 * @group Result endpoints
 */
class ResultController extends Controller
{
    public function __construct(
        protected ResultService $resultService
    ) {
    }

    /**
     * POST Result
     *
     * Create a new result for a user.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     */
    public function store(ResultRequest $request)
    {
        $result = $this->resultService->store($request->validated());

        return new ResultResource($result);
    }

    /**
     * GET Result
     *
     * Get the results of a user.
     *
     * @response 200 {"message":"OK"}
     * @response 404 {"message": "Not Found"}
     */
    public function show(User $user)
    {
        $totalPoints = $this->resultService->show($user);

        return response()->json([
            'data' => $totalPoints,
        ]);
    }
}
