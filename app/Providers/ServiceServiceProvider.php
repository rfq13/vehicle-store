<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VehicleService;
use App\Services\VehicleServiceInterface;
use App\Services\TransactionService;
use App\Services\TransactionServiceInterface;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            VehicleServiceInterface::class,
            VehicleService::class
        );
        $this->app->bind(
            TransactionServiceInterface::class,
            TransactionService::class
        );
    }
}
