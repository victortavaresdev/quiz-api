<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\Achievement\AchievementDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Achievement\AchievementRequest;
use App\Http\Resources\Achievement\AchievementResource;
use App\Models\User;
use App\Services\Achievement\AchievementService;

/**
 * @group Achievement endpoints
 */
class AchievementController extends Controller
{
    public function __construct(
        protected AchievementService $achievementService
    ) {
    }

    /**
     * POST Achievement
     *
     * Create a new achievement for a user.
     *
     * @authenticated
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     */
    public function store(AchievementRequest $request)
    {
        $dto = AchievementDTO::fromRequest($request);
        $achievement = $this->achievementService->store($dto);

        return new AchievementResource($achievement);
    }

    /**
     * GET Achievements
     *
     * Get the achievements list of a user.
     *
     * @response 200 {"message":"OK"}
     * @response 404 {"message": "Not Found"}
     */
    public function index(User $user)
    {
        $achievements = $this->achievementService->index($user);

        return AchievementResource::collection($achievements);
    }
}
