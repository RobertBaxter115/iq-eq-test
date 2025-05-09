<?php

namespace Tests\Unit\Jobs;

use App\Jobs\UpdateVehicleFlat;
use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use App\Models\VehicleMake;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateVehicleFlatTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_updates_vehicle_flat_table(): void
    {
        // Create required relationships
        $make = VehicleMake::factory()->create();
        $type = VehicleType::factory()->create();
        
        // Create a vehicle with relationships
        $vehicle = Vehicle::factory()->create([
            'vehicle_make_id' => $make->id,
            'vehicle_type_id' => $type->id,
            'model' => 'Test Model',
            'year' => 2024
        ]);

        $attributes = [
            'top_speed' => '200',
            'weight' => '1500',
            'length' => '4.5',
        ];

        foreach ($attributes as $name => $value) {
            $attribute = VehicleAttribute::factory()->create([
                'name' => $name,
                'data_type' => is_numeric($value) ? 'float' : 'string',
                'unit' => $name === 'top_speed' ? 'km/h' : ($name === 'weight' ? 'kg' : 'm'),
            ]);

            $vehicle->attributes()->attach($attribute->id, ['value' => $value]);
        }

        // Run the job
        $job = new UpdateVehicleFlat($vehicle);
        $job->handle();

        // Assert the flat table was updated
        $this->assertDatabaseHas('vehicle_flats', [
            'vehicle_id' => $vehicle->id,
            'model' => 'Test Model',
            'year' => 2024,
            'make_name' => $make->name,
            'type_name' => $type->name,
            'top_speed' => '200',
            'weight' => '1500',
            'length' => '4.5',
        ]);
    }

    public function test_job_handles_missing_attributes(): void
    {
        // Create required relationships
        $make = VehicleMake::factory()->create();
        $type = VehicleType::factory()->create();
        
        // Create a vehicle with relationships
        $vehicle = Vehicle::factory()->create([
            'vehicle_make_id' => $make->id,
            'vehicle_type_id' => $type->id,
            'model' => 'Test Model',
            'year' => 2024
        ]);

        $job = new UpdateVehicleFlat($vehicle);
        $job->handle();

        // Assert the flat table was created with null values for attributes
        $this->assertDatabaseHas('vehicle_flats', [
            'vehicle_id' => $vehicle->id,
            'model' => 'Test Model',
            'year' => 2024,
            'make_name' => $make->name,
            'type_name' => $type->name,
            'top_speed' => null,
            'weight' => null,
            'length' => null,
        ]);
    }
}
