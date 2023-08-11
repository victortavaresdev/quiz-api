<?php

namespace App\Services\Leaderboard;

use App\Models\User;

class LeaderboardService
{
    public function index()
    {
        $leaderboard = User::withSum('results', 'total_points')
            ->withCount('results')
            ->whereHas('results', function ($query) {
                $query->where('total_points', '>', 0);
            })
            ->orderBy('results_sum_total_points', 'desc')
            ->paginate(5);

        return $leaderboard;
    }
}
