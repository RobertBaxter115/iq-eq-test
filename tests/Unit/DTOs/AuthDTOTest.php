<?php

namespace Tests\Unit\DTOs;

use App\DTOs\AuthDTO;
use Tests\TestCase;
use Illuminate\Http\Request;

class AuthDTOTest extends TestCase
{
    public function test_can_create_auth_dto_from_array(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $dto = AuthDTO::fromArray($data);

        $this->assertEquals($data['name'], $dto->name);
        $this->assertEquals($data['email'], $dto->email);
        $this->assertEquals($data['password'], $dto->password);
    }

    public function test_can_create_auth_dto_from_request(): void
    {
        $request = new Request([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $dto = AuthDTO::fromRequest($request);

        $this->assertEquals($request->name, $dto->name);
        $this->assertEquals($request->email, $dto->email);
        $this->assertEquals($request->password, $dto->password);
    }
}
