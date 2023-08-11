<?php

namespace App\Services\Achievement;

use App\DTO\Achievement\AchievementDTO;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AchievementService
{
    public function store(AchievementDTO $dto): Achievement
    {
        $achievement = Achievement::create([
            ...(array) $dto,
            'user_id' => auth('api')->user()->id,
        ]);

        return $achievement;
    }

    public function index(User $user): Collection
    {
        $achievements = $user->achievements()->get();

        return $achievements;
    }
}
