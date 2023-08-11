<?php

namespace App\Console\Commands;

use App\Enums\AchievementType;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateUserCommand extends Command
{
    protected $signature = 'users:create';

    protected $description = 'Command to create a user.';

    public function handle()
    {
        $user['name'] = $this->ask('Name of the new user');
        $user['email'] = $this->ask('Email of the new user');
        $user['password'] = $this->secret('Password of the new user');

        $user['role'] = $this->choice('Role of the new user', ['USER', 'ADMIN'], 0);

        $validator = Validator::make(
            $user,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'password' => ['required', 'string', 'min:6', 'max:255'],
                'role' => ['required', 'string', Rule::in(['USER', 'ADMIN'])],
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return -1;
        }

        $createdUser = User::create($user);

        Achievement::create([
            'achievement_type' => AchievementType::READY_TO_PLAY->value,
            'unlocked_at' => now(),
            'user_id' => $createdUser->id,
        ]);

        $this->info("User '{$user['email']}' created successfully");

        return 0;
    }
}
