<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\VehicleMakeServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleMakeResource;
use App\Models\VehicleType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleMakeController extends Controller
{
    public function __construct(
        private readonly VehicleMakeServiceInterface $vehicleMakeService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/vehicle-types/{vehicleType}/makes",
     *     summary="Get all vehicle makes that manufacture a specific type of vehicle",
     *     tags={"Vehicle Makes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="vehicleType",
     *         in="path",
     *         required=true,
     *         description="Vehicle Type ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of vehicle makes retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/VehicleMakeResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle type not found",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function getMakesByType(VehicleType $vehicleType): AnonymousResourceCollection
    {
        $makes = $this->vehicleMakeService->getMakesByType($vehicleType);
        return VehicleMakeResource::collection($makes);
    }
}
