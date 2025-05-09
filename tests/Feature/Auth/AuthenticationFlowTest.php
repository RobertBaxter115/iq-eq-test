<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;

class AuthenticationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_authentication_flow(): void
    {
        // 1. Register
        $registerData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $registerResponse = $this->postJson('/api/register', $registerData);
        $registerResponse->assertStatus(201);
        $token = $registerResponse->json('token');

        // 2. Try to access protected route
        $protectedResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/vehicles/1');
        $protectedResponse->assertStatus(200);

        // 3. Logout
        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');
        $logoutResponse->assertStatus(200);

        // 4. Try to access protected route after logout
        $protectedResponseAfterLogout = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/vehicles/1');
        $protectedResponseAfterLogout->assertStatus(401);
    }

    public function test_token_expiration(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token', ['*'], now()->addSeconds(1))->plainTextToken;

        // Wait for token to expire
        sleep(2);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/vehicles/1');

        $response->assertStatus(401);
    }
}
