<?php

namespace App\Contracts\Services;

use App\DTOs\AuthDTO;
use App\DTOs\LoginDTO;
use App\DTOs\Responses\AuthResponseDTO;
use App\Models\User;

interface AuthServiceInterface
{
    public function register(AuthDTO $authDTO): AuthResponseDTO;
    public function login(LoginDTO $loginDTO): AuthResponseDTO;
    public function logout(User $user): void;
}
