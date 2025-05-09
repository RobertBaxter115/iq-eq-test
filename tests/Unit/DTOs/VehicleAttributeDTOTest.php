<?php

namespace Tests\Unit\DTOs;

use App\DTOs\VehicleAttributeDTO;
use Tests\TestCase;
use Illuminate\Http\Request;

class VehicleAttributeDTOTest extends TestCase
{
    public function test_can_create_dto_from_array(): void
    {
        $data = [
            'name' => 'top_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ];

        $dto = VehicleAttributeDTO::fromArray($data);

        $this->assertEquals($data['name'], $dto->name);
        $this->assertEquals($data['description'], $dto->description);
        $this->assertEquals($data['data_type'], $dto->data_type);
        $this->assertEquals($data['unit'], $dto->unit);
    }

    public function test_can_create_dto_from_request(): void
    {
        $request = new Request([
            'name' => 'Speed',
            'description' => 'Vehicle speed',
            'data_type' => 'float',
            'unit' => 'km/h'
        ]);

        $dto = VehicleAttributeDTO::fromRequest($request);

        $this->assertEquals($request->name, $dto->name);
        $this->assertEquals($request->description, $dto->description);
        $this->assertEquals($request->data_type, $dto->data_type);
        $this->assertEquals($request->unit, $dto->unit);
    }

    public function test_can_convert_dto_to_array(): void
    {
        $data = [
            'name' => 'top_speed',
            'description' => 'Maximum speed',
            'data_type' => 'integer',
            'unit' => 'km/h'
        ];

        $dto = VehicleAttributeDTO::fromArray($data);
        $array = $dto->toArray();

        $this->assertEquals($data, $array);
    }
}
