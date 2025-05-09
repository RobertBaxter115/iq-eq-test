<?php

namespace Tests\Unit\Providers;

use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Services\VehicleAttributeServiceInterface;
use App\Contracts\Services\VehicleMakeServiceInterface;
use App\Contracts\Services\VehicleServiceInterface;
use App\Services\AuthService;
use App\Services\VehicleAttributeService;
use App\Services\VehicleMakeService;
use App\Services\VehicleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_provider_binds_interfaces_to_implementations(): void
    {
        $this->assertInstanceOf(
            AuthService::class,
            $this->app->make(AuthServiceInterface::class)
        );

        $this->assertInstanceOf(
            VehicleService::class,
            $this->app->make(VehicleServiceInterface::class)
        );

        $this->assertInstanceOf(
            VehicleMakeService::class,
            $this->app->make(VehicleMakeServiceInterface::class)
        );

        $this->assertInstanceOf(
            VehicleAttributeService::class,
            $this->app->make(VehicleAttributeServiceInterface::class)
        );
    }
}
