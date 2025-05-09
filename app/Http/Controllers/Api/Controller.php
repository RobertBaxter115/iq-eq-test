<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Vehicle Management API",
 *     description="API documentation for Vehicle Management System",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Local API Server"
 * )
 *
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="Docker API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *     schema="VehicleResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="model", type="string", example="Camry"),
 *     @OA\Property(property="year", type="integer", example=2023),
 *     @OA\Property(property="type", type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Sedan")
 *     ),
 *     @OA\Property(property="make", type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Toyota")
 *     ),
 *     @OA\Property(property="attributes", type="array",
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="name", type="string", example="top_speed"),
 *             @OA\Property(property="value", type="string", example="210"),
 *             @OA\Property(property="unit", type="string", example="km/h")
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="VehicleMakeResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Toyota"),
 *     @OA\Property(property="country_of_origin", type="string", example="Japan"),
 *     @OA\Property(property="founded_year", type="integer", example=1937)
 * )
 *
 * @OA\Schema(
 *     schema="VehicleAttributeResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="top_speed"),
 *     @OA\Property(property="description", type="string", example="Maximum speed of the vehicle"),
 *     @OA\Property(property="unit", type="string", example="km/h"),
 *     @OA\Property(property="data_type", type="string", example="integer")
 * )
 *
 * @OA\Schema(
 *     schema="Error",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="Error message"),
 *     @OA\Property(property="errors", type="object",
 *         @OA\Property(property="field", type="array",
 *             @OA\Items(type="string", example="Error message for field")
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="ValidationError",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="The given data was invalid."),
 *     @OA\Property(property="errors", type="object",
 *         @OA\Property(property="field", type="array",
 *             @OA\Items(type="string", example="The field is required.")
 *         )
 *     )
 * )
 */
class Controller extends BaseController
{
}
