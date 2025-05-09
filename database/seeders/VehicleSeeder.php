<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleAttribute;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'vehicle_type_id' => 1, // Sedan
                'vehicle_make_id' => 1, // Toyota
                'model' => 'Camry',
                'year' => 2023,
                'attributes' => [
                    'top_speed' => 210,
                    'length' => 4.88,
                    'width' => 1.84,
                    'height' => 1.44,
                    'weight' => 1550,
                    'engine_type' => 'V6',
                    'engine_displacement' => 3500,
                    'horsepower' => 301,
                    'torque' => 362,
                    'transmission_type' => 'Automatic',
                    'number_of_gears' => 8,
                    'fuel_type' => 'Petrol',
                    'fuel_capacity' => 60,
                    'fuel_economy' => 7.8,
                ],
            ],
            [
                'vehicle_type_id' => 2, // SUV
                'vehicle_make_id' => 2, // BMW
                'model' => 'X5',
                'year' => 2023,
                'attributes' => [
                    'top_speed' => 250,
                    'length' => 4.92,
                    'width' => 2.00,
                    'height' => 1.74,
                    'weight' => 2140,
                    'engine_type' => 'Inline-6',
                    'engine_displacement' => 3000,
                    'horsepower' => 335,
                    'torque' => 450,
                    'transmission_type' => 'Automatic',
                    'number_of_gears' => 8,
                    'fuel_type' => 'Diesel',
                    'fuel_capacity' => 80,
                    'fuel_economy' => 8.5,
                ],
            ],
            [
                'vehicle_type_id' => 3, // Hatchback
                'vehicle_make_id' => 5, // Honda
                'model' => 'Civic',
                'year' => 2023,
                'attributes' => [
                    'top_speed' => 200,
                    'length' => 4.55,
                    'width' => 1.80,
                    'height' => 1.41,
                    'weight' => 1270,
                    'engine_type' => 'Inline-4',
                    'engine_displacement' => 2000,
                    'horsepower' => 158,
                    'torque' => 187,
                    'transmission_type' => 'CVT',
                    'number_of_gears' => 0,
                    'fuel_type' => 'Petrol',
                    'fuel_capacity' => 47,
                    'fuel_economy' => 6.2,
                ],
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $attributes = $vehicleData['attributes'];
            unset($vehicleData['attributes']);

            $vehicle = Vehicle::create($vehicleData);

            // Attach attributes with their values
            foreach ($attributes as $name => $value) {
                $attribute = VehicleAttribute::where('name', $name)->first();
                if ($attribute) {
                    $vehicle->attributes()->attach($attribute->id, ['value' => $value]);
                }
            }
        }
    }
} 