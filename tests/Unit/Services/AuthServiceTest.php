<?php

namespace Tests\Feature\Services;

use App\DTOs\AuthDTO;
use App\DTOs\LoginDTO;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_user()
    {
        $service = new AuthService();
        $dto = new AuthDTO('John Doe', 'john@example.com', 'password123');

        $response = $service->register($dto);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $this->assertEquals('John Doe', $response->user->name);
        $this->assertNotEmpty($response->token);
        $this->assertTrue(Hash::check('password123', $response->user->password));
    }

    public function test_can_login_user_with_valid_credentials()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);
        $service = new AuthService();
        $dto = new LoginDTO($user->email, 'password123');

        $response = $service->login($dto);

        $this->assertEquals($user->id, $response->user->id);
        $this->assertNotEmpty($response->token);
    }

    public function test_throws_exception_with_invalid_credentials()
    {
        $this->expectException(InvalidCredentialsException::class);

        $user = User::factory()->create(['password' => bcrypt('password123')]);
        $service = new AuthService();
        $dto = new LoginDTO($user->email, 'wrong_password');

        $service->login($dto);
    }

    public function test_throws_exception_when_user_not_found()
    {
        $this->expectException(InvalidCredentialsException::class);

        $service = new AuthService();
        $dto = new LoginDTO('nonexistent@example.com', 'password123');

        $service->login($dto);
    }

    public function test_can_logout_user()
    {
        $user = User::factory()->create();
        $service = new AuthService();

        $user->createToken('auth_token'); // create a token
        $this->assertCount(1, $user->tokens);

        $service->logout($user);

        $this->assertCount(0, $user->fresh()->tokens);
    }
}
