<?php

namespace App\Services\User;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Enums\AchievementType;
use App\Exceptions\Custom\ConflictException;
use App\Models\Achievement;
use App\Models\User;

class UserService
{
    public function store(CreateUserDTO $dto): User
    {
        $userEmail = User::where('email', $dto->email)->first();
        if ($userEmail) {
            throw new ConflictException('Usuário já registrado.');
        }

        $user = User::create((array) $dto);

        Achievement::create([
            'achievement_type' => AchievementType::READY_TO_PLAY->value,
            'unlocked_at' => now(),
            'user_id' => $user->id,
        ]);

        return $user;
    }

    public function update(User $user, UpdateUserDTO $dto): ?User
    {
        $user->update(array_filter((array) $dto));

        return $user;
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }
}
