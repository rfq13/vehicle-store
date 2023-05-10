<?php
namespace App\Services;

use App\Repositories\VehicleRepository;


interface VehicleServiceInterface
{
    public function getStock();
    public function sellVehicle($id);
    public function getSalesReport();
}

class VehicleService implements VehicleServiceInterface
{
    private $vehicleRepo;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepo = $vehicleRepo;
    }

    public function getStock()
    {
        return $this->vehicleRepo->getVehiclesWithMotorsAndCars();
    }

    public function sellVehicle($id)
    {
        $vehicle = $this->vehicleRepo->decrementStock($id);

        return $vehicle;
    }

    public function getSalesReport()
    {
        return $this->vehicleRepo->all();
    }
}
