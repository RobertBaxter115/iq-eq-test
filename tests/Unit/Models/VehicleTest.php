<?php

namespace Tests\Unit\Models;

use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use App\Models\VehicleMake;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $this->assertInstanceOf(Vehicle::class, $vehicle);
        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'model' => $vehicle->model,
            'year' => $vehicle->year,
        ]);
    }

    public function test_vehicle_belongs_to_type(): void
    {
        $vehicle = Vehicle::factory()->create();

        $this->assertInstanceOf(VehicleType::class, $vehicle->type);
    }

    public function test_vehicle_belongs_to_make(): void
    {
        $vehicle = Vehicle::factory()->create();

        $this->assertInstanceOf(VehicleMake::class, $vehicle->make);
    }

    public function test_vehicle_has_many_attributes(): void
    {
        $vehicle = Vehicle::factory()->create();
        $attribute = VehicleAttribute::factory()->create();

        $vehicle->attributes()->attach($attribute->id, ['value' => 'test-value']);

        $this->assertCount(1, $vehicle->attributes);
        $this->assertInstanceOf(VehicleAttribute::class, $vehicle->attributes->first());
        $this->assertEquals('test-value', $vehicle->attributes->first()->pivot->value);
    }
}
