<?php

namespace Tests\Feature\Services;

use App\Models\VehicleAttribute;
use App\Services\VehicleAttributeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleAttributeServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_attributes()
    {
        VehicleAttribute::factory()->create(['name' => 'top_speed']);
        VehicleAttribute::factory()->create(['name' => 'weight']);

        $service = new VehicleAttributeService();
        $result = $service->getAllAttributes();

        $this->assertCount(2, $result);
        $this->assertEquals('top_speed', $result[0]->name);
        $this->assertEquals('weight', $result[1]->name);
    }

    public function test_can_get_attribute_by_id()
    {
        $attribute = VehicleAttribute::factory()->create([
            'name' => 'top_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ]);

        $service = new VehicleAttributeService();
        $result = $service->getAttributeById($attribute->id);

        $this->assertEquals('top_speed', $result->attribute->name);
    }

    public function test_can_create_attribute()
    {
        $data = [
            'name' => 'top_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ];

        $service = new VehicleAttributeService();
        $result = $service->createAttribute($data);

        $this->assertDatabaseHas('vehicle_attributes', ['name' => 'top_speed']);
        $this->assertEquals('top_speed', $result->attribute->name);
    }

    public function test_can_update_attribute()
    {
        $attribute = VehicleAttribute::factory()->create([
            'name' => 'top_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ]);

        $data = [
            'name' => 'max_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ];

        $service = new VehicleAttributeService();
        $result = $service->updateAttribute($attribute, $data);

        $this->assertEquals('max_speed', $result->attribute->name);
        $this->assertDatabaseHas('vehicle_attributes', ['name' => 'max_speed']);
    }

    public function test_can_delete_attribute()
    {
        $attribute = VehicleAttribute::factory()->create();

        $service = new VehicleAttributeService();
        $result = $service->deleteAttribute($attribute);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('vehicle_attributes', ['id' => $attribute->id]);
    }
}
