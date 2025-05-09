<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    public function test_can_get_vehicle_details(): void
    {
        $vehicle = Vehicle::factory()->create();
        $attribute = VehicleAttribute::factory()->create();

        $vehicle->attributes()->attach($attribute->id, ['value' => 'test-value']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson("/api/vehicles/{$vehicle->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'type' => [
                        'id',
                        'name',
                    ],
                    'make' => [
                        'id',
                        'name',
                    ],
                    'model',
                    'year',
                    'attributes' => [
                        '*' => [
                            'name',
                            'value',
                            'unit',
                        ],
                    ],
                ],
            ]);
    }

    public function test_can_update_vehicle_parameter(): void
    {
        $vehicle = Vehicle::factory()->create();
        $attribute = VehicleAttribute::factory()->create();

        $vehicle->attributes()->attach($attribute->id, ['value' => 'old-value']);

        $updateData = [
            'parameter' => $attribute->name,
            'value' => 'new-value',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->patchJson("/api/vehicles/{$vehicle->id}/parameters", $updateData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'attributes' => [
                        '*' => [
                            'name',
                            'value',
                            'unit',
                        ],
                    ],
                ],
            ]);

        $this->assertDatabaseHas('vehicle_attribute_vehicle', [
            'vehicle_id' => $vehicle->id,
            'vehicle_attribute_id' => $attribute->id,
            'value' => 'new-value',
        ]);
    }

    public function test_returns_404_for_nonexistent_vehicle(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/vehicles/999');

        $response->assertStatus(404);
    }
}
