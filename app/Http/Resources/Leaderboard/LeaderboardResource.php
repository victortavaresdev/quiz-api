<?php

namespace App\Http\Resources\Leaderboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 *
 * @property int $results_sum_total_points
 */
class LeaderboardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->name,
            'image' => $this->image,
            'totalQuizzes' => $this->results_count,
            'totalScore' => (int) $this->results_sum_total_points,
        ];
    }
}
