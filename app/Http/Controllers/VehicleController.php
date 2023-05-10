<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VehicleServiceInterface;

class VehicleController extends Controller
{
    private $vehicleService;

    public function __construct(VehicleServiceInterface $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function getStock()
    {
        return $this->vehicleService->getStock();
    }

    public function sellVehicle(Request $request, $id)
    {
        return $this->vehicleService->sellVehicle($id);
    }

    public function getSalesReport()
    {
        return $this->vehicleService->getSalesReport();
    }
}
