<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Leaderboard\LeaderboardResource;
use App\Services\Leaderboard\LeaderboardService;

/**
 * @group Leaderboard endpoints
 */
class LeaderboardController extends Controller
{
    public function __construct(
        protected LeaderboardService $leaderboardService
    ) {
    }

    /**
     * GET Leaderboard
     *
     * Get leaderboard data.
     *
     * @response 200 {"message":"OK"}
     */
    public function index()
    {
        $leaderboard = $this->leaderboardService->index();

        return LeaderboardResource::collection($leaderboard);
    }
}
