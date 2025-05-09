<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\VehicleAttributeServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleAttributeRequest;
use App\Http\Resources\VehicleAttributeResource;
use App\Models\VehicleAttribute;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VehicleAttributeController extends Controller
{
    public function __construct(
        private readonly VehicleAttributeServiceInterface $attributeService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/vehicle-attributes",
     *     summary="Get all vehicle attributes",
     *     tags={"Vehicle Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of vehicle attributes",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="top_speed"),
     *                 @OA\Property(property="description", type="string", example="Maximum speed of the vehicle"),
     *                 @OA\Property(property="data_type", type="string", example="float"),
     *                 @OA\Property(property="unit", type="string", example="km/h")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $attributes = $this->attributeService->getAllAttributes();
        return VehicleAttributeResource::collection($attributes);
    }

    /**
     * @OA\Post(
     *     path="/vehicle-attributes",
     *     summary="Create a new vehicle attribute",
     *     tags={"Vehicle Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "data_type"},
     *             @OA\Property(property="name", type="string", example="battery_capacity"),
     *             @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Battery capacity for electric vehicles"
     *             ),
     *             @OA\Property(property="data_type", type="string", example="float"),
     *             @OA\Property(property="unit", type="string", example="kWh")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Attribute created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(VehicleAttributeRequest $request): VehicleAttributeResource
    {
        $response = $this->attributeService->createAttribute($request->validated());
        return new VehicleAttributeResource($response->attribute);
    }

    /**
     * @OA\Get(
     *     path="/vehicle-attributes/{id}",
     *     summary="Get a specific vehicle attribute",
     *     tags={"Vehicle Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vehicle attribute details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle attribute not found"
     *     )
     * )
     */
    public function show(VehicleAttribute $attribute): VehicleAttributeResource
    {
        $response = $this->attributeService->getAttributeById($attribute->id);
        return new VehicleAttributeResource($response->attribute);
    }

    /**
     * @OA\Put(
     *     path="/vehicle-attributes/{id}",
     *     summary="Update a vehicle attribute",
     *     tags={"Vehicle Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "data_type"},
     *             @OA\Property(property="name", type="string", example="battery_capacity"),
     *             @OA\Property(property="description", type="string", example="Updated description"),
     *             @OA\Property(property="data_type", type="string", example="float"),
     *             @OA\Property(property="unit", type="string", example="kWh")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attribute updated successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(VehicleAttributeRequest $request, VehicleAttribute $attribute): VehicleAttributeResource
    {
        $response = $this->attributeService->updateAttribute(
            $attribute,
            $request->validated()
        );
        return new VehicleAttributeResource($response->attribute);
    }

    /**
     * @OA\Delete(
     *     path="/vehicle-attributes/{id}",
     *     summary="Delete a vehicle attribute",
     *     tags={"Vehicle Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Attribute deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle attribute not found"
     *     )
     * )
     */
    public function destroy(VehicleAttribute $attribute): Response
    {
        $this->attributeService->deleteAttribute($attribute);
        return response()->noContent();
    }
}
