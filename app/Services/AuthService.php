<?php

namespace App\Services;

use App\Contracts\Services\AuthServiceInterface;
use App\DTOs\AuthDTO;
use App\DTOs\LoginDTO;
use App\DTOs\Responses\AuthResponseDTO;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function register(AuthDTO $authDTO): AuthResponseDTO
    {
        $user = User::create([
            'name' => $authDTO->name,
            'email' => $authDTO->email,
            'password' => Hash::make($authDTO->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return new AuthResponseDTO(
            user: $user,
            token: $token,
        );
    }

    public function login(LoginDTO $loginDTO): AuthResponseDTO
    {
        $user = User::where('email', $loginDTO->email)->first();

        if (!$user || !Hash::check($loginDTO->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return new AuthResponseDTO(
            user: $user,
            token: $token,
        );
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
