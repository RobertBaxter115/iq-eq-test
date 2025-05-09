<?php

namespace Tests\Unit\Services;

use App\Models\Vehicle;
use App\Models\VehicleMake;
use App\Models\VehicleType;
use App\Services\VehicleMakeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleMakeServiceTest extends TestCase
{
    use RefreshDatabase;

    private $vehicleMakeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->vehicleMakeService = new VehicleMakeService();
    }

    public function test_can_get_makes_by_type(): void
    {
        $make1 = VehicleMake::factory()->create(['name' => 'Toyota']);
        $make2 = VehicleMake::factory()->create(['name' => 'Honda']);
        $type = VehicleType::factory()->create();

        Vehicle::factory()->create(['vehicle_make_id' => $make1->id, 'vehicle_type_id' => $type->id]);
        Vehicle::factory()->create(['vehicle_make_id' => $make2->id, 'vehicle_type_id' => $type->id]);
        Vehicle::factory()->create(['vehicle_make_id' => $make1->id, 'vehicle_type_id' => $type->id]); // Duplicate make

        $makes = $this->vehicleMakeService->getMakesByType($type);

        $this->assertCount(2, $makes);
        $this->assertEquals('Toyota', $makes[0]->name);
        $this->assertEquals('Honda', $makes[1]->name);
    }
}
