<?php

namespace App\Http\Resources\Achievement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Achievement
 */
class AchievementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'achievementType' => $this->achievement_type,
            'unlockedAt' => $this->unlocked_at,
        ];
    }
}
