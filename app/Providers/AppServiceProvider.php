<?php

namespace App\Providers;

use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Services\VehicleAttributeServiceInterface;
use App\Contracts\Services\VehicleMakeServiceInterface;
use App\Contracts\Services\VehicleServiceInterface;
use App\Services\AuthService;
use App\Services\VehicleAttributeService;
use App\Services\VehicleMakeService;
use App\Services\VehicleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VehicleServiceInterface::class, VehicleService::class);
        $this->app->bind(VehicleMakeServiceInterface::class, VehicleMakeService::class);
        $this->app->bind(VehicleAttributeServiceInterface::class, VehicleAttributeService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
