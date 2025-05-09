<?php

namespace Tests\Unit\Services;

use App\Jobs\UpdateVehicleFlat;
use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use App\Services\VehicleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class VehicleServiceTest extends TestCase
{
    use RefreshDatabase;

    private $vehicleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->vehicleService = new VehicleService();
        Bus::fake();
    }

    public function test_can_update_vehicle_parameter(): void
    {
        $vehicle = Vehicle::factory()->create();
        $parameterDTO = new \App\DTOs\VehicleParameterDTO(
            parameter: 'top_speed',
            value: '200'
        );

        $result = $this->vehicleService->updateParameter($vehicle, $parameterDTO);

        $attribute = VehicleAttribute::where('name', 'top_speed')->first();

        $this->assertSame($vehicle->id, $result->id);
        $this->assertDatabaseHas('vehicle_vehicle_attribute', [
            'vehicle_id' => $vehicle->id,
            'vehicle_attribute_id' => $attribute->id,
            'value' => '200',
        ]);
        Bus::assertDispatched(UpdateVehicleFlat::class);
    }

    public function test_determines_correct_data_type(): void
    {
        $this->assertEquals('integer', $this->vehicleService->determineDataType(100));
        $this->assertEquals('float', $this->vehicleService->determineDataType(100.5));
        $this->assertEquals('boolean', $this->vehicleService->determineDataType(true));
        $this->assertEquals('string', $this->vehicleService->determineDataType('test'));
    }

    public function test_determines_correct_unit(): void
    {
        $this->assertEquals('km/h', $this->vehicleService->determineUnit('top_speed'));
        $this->assertEquals('m', $this->vehicleService->determineUnit('length'));
        $this->assertEquals('kg', $this->vehicleService->determineUnit('weight'));
        $this->assertEquals('cc', $this->vehicleService->determineUnit('engine_displacement'));
        $this->assertEquals('Nm', $this->vehicleService->determineUnit('torque'));
        $this->assertEquals('L', $this->vehicleService->determineUnit('fuel_capacity'));
        $this->assertEquals('L/100km', $this->vehicleService->determineUnit('fuel_economy'));
        $this->assertNull($this->vehicleService->determineUnit('unknown'));
    }
}
