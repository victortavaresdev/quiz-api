<?php

namespace Database\Factories;

use App\Enums\AchievementType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'achievement_type' => AchievementType::READY_TO_PLAY->value,
            'unlocked_at' => now(),
        ];
    }
}
