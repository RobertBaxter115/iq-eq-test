<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicle_attributes')->ignore($this->vehicle_attribute),
            ],
            'description' => 'nullable|string',
            'data_type' => 'required|string|in:string,integer,float,boolean',
            'unit' => 'nullable|string|max:50',
        ];
    }
}
