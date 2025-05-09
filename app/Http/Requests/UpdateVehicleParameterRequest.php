<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleParameterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parameter' => ['required', 'string', Rule::in([
                'top_speed',
                'length',
                'width',
                'height',
                'weight',
                'engine_type',
                'engine_displacement',
                'horsepower',
                'torque',
                'transmission_type',
                'number_of_gears',
                'fuel_type',
                'fuel_capacity',
                'fuel_economy',
            ])],
            'value' => ['required'],
        ];
    }
}
