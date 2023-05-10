<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VehicleServiceInterface;
use App\Http\Response\BaseResponse;

class VehicleController extends Controller
{
    private $vehicleService;

    public function __construct(VehicleServiceInterface $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function getStock()
    {
        return BaseResponse::success($this->vehicleService->getVehiclesWithMotorsAndCars());
    }
}
