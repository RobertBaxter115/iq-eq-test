<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\VehicleServiceInterface;
use App\DTOs\VehicleParameterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVehicleParameterRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleController extends Controller
{
    public function __construct(
        private readonly VehicleServiceInterface $vehicleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/vehicles/{vehicle}",
     *     summary="Get detailed information about a specific vehicle",
     *     tags={"Vehicles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="vehicle",
     *         in="path",
     *         required=true,
     *         description="Vehicle ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vehicle details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VehicleResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle not found",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function getVehicleDetails(Vehicle $vehicle): VehicleResource
    {
        return new VehicleResource($vehicle);
    }

    /**
     * @OA\Patch(
     *     path="/vehicles/{vehicle}/parameters",
     *     summary="Update a specific parameter of a vehicle",
     *     tags={"Vehicles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="vehicle",
     *         in="path",
     *         required=true,
     *         description="Vehicle ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"parameter", "value"},
     *             @OA\Property(property="parameter", type="string", example="top_speed"),
     *             @OA\Property(property="value", type="string", example="220")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vehicle parameter updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="model", type="string", example="Camry"),
     *             @OA\Property(property="year", type="integer", example=2023),
     *             @OA\Property(property="attributes", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="name", type="string", example="top_speed"),
     *                     @OA\Property(property="value", type="string", example="220"),
     *                     @OA\Property(property="unit", type="string", example="km/h")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function updateVehicleParameter(
        UpdateVehicleParameterRequest $request,
        Vehicle $vehicle
    ): VehicleResource {
        $parameterDTO = VehicleParameterDTO::fromRequest($request->validated());
        $updatedVehicle = $this->vehicleService->updateParameter($vehicle, $parameterDTO);

        return new VehicleResource($updatedVehicle);
    }
}
