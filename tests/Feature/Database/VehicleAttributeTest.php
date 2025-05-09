<?php

namespace Tests\Feature\Database;

use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;


class VehicleAttributeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_vehicle_attribute(): void
    {
        $attribute = VehicleAttribute::factory()->create();

        $this->assertDatabaseHas('vehicle_attributes', [
            'id' => $attribute->id,
            'name' => $attribute->name,
            'description' => $attribute->description,
            'data_type' => $attribute->data_type,
            'unit' => $attribute->unit,
        ]);
    }

    public function test_can_attach_attribute_to_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();
        $attribute = VehicleAttribute::factory()->create();
        $value = 'test-value';

        $vehicle->attributes()->attach($attribute->id, ['value' => $value]);

        $this->assertDatabaseHas('vehicle_attribute_vehicle', [
            'vehicle_id' => $vehicle->id,
            'vehicle_attribute_id' => $attribute->id,
            'value' => $value,
        ]);
    }

    public function test_can_update_vehicle_attribute_value(): void
    {
        $vehicle = Vehicle::factory()->create();
        $attribute = VehicleAttribute::factory()->create();
        $oldValue = 'old-value';
        $newValue = 'new-value';

        $vehicle->attributes()->attach($attribute->id, ['value' => $oldValue]);
        $vehicle->attributes()->updateExistingPivot($attribute->id, ['value' => $newValue]);

        $this->assertDatabaseHas('vehicle_attribute_vehicle', [
            'vehicle_id' => $vehicle->id,
            'vehicle_attribute_id' => $attribute->id,
            'value' => $newValue,
        ]);
    }
}
