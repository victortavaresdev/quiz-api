<?php

namespace App\Services\Auth;

use App\DTO\Auth\LoginDTO;
use App\Exceptions\Custom\BadRequestException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(LoginDTO $dto, ?string $userAgent): string
    {
        $user = User::where('email', $dto->email)->first();
        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw new BadRequestException('Credenciais inválidas.');
        }

        $device = substr($userAgent ?? '', 0, 255);
        $user->tokens()->delete();

        $token = $user->createToken($device)->plainTextToken;

        return $token;
    }
}
