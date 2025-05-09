<?php

namespace Tests\Unit\DTOs;

use App\DTOs\LoginDTO;
use Tests\TestCase;
use Illuminate\Http\Request;

class LoginDTOTest extends TestCase
{
    public function test_can_create_login_dto_from_array(): void
    {
        $data = [
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $dto = LoginDTO::fromArray($data);

        $this->assertEquals($data['email'], $dto->email);
        $this->assertEquals($data['password'], $dto->password);
    }

    public function test_can_create_login_dto_from_login_request(): void
    {
        $request = new Request([
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $dto = LoginDTO::fromRequest($request);

        $this->assertEquals($request->email, $dto->email);
        $this->assertEquals($request->password, $dto->password);
    }
}
