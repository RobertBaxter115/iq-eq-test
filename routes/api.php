<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VehicleAttributeController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\VehicleMakeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Vehicle attributes management
    Route::apiResource('vehicle-attributes', VehicleAttributeController::class);

    // Existing vehicle routes
    Route::get('vehicle-types/{vehicleType}/makes', [VehicleMakeController::class, 'getMakesByType'])
        ->name('api.vehicle-types.makes');
    Route::get('vehicles/{vehicle}', [VehicleController::class, 'getVehicleDetails'])
        ->name('api.vehicles.show');
    Route::patch('vehicles/{vehicle}/parameters', [VehicleController::class, 'updateVehicleParameter'])
        ->name('api.vehicles.update-parameter');
}); 