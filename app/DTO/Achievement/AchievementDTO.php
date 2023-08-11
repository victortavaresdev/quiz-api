<?php

namespace App\DTO\Achievement;

use App\Http\Requests\Achievement\AchievementRequest;

class AchievementDTO
{
    public function __construct(
        public readonly string $achievement_type,
        public readonly string $unlocked_at
    ) {
    }

    public static function fromRequest(AchievementRequest $request): self
    {
        return new self(
            achievement_type: $request->validated('achievement_type'),
            unlocked_at: $request->validated('unlocked_at')
        );
    }
}
