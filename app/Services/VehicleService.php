<?php
namespace App\Services;

use App\Repositories\VehicleRepository;


interface VehicleServiceInterface
{
    public function getVehiclesWithMotorsAndCars();
    public function decrementStock($id);
    public function all();
}

class VehicleService implements VehicleServiceInterface
{
    private $vehicleRepo;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepo = $vehicleRepo;
    }

    public function getVehiclesWithMotorsAndCars()
    {
        return $this->vehicleRepo->getVehiclesWithMotorsAndCars();
    }

    public function decrementStock($id)
    {
        $vehicle = $this->vehicleRepo->decrementStock($id);

        return $vehicle;
    }

    public function all()
    {
        return $this->vehicleRepo->all();
    }

    public function find($id)
    {
        return $this->vehicleRepo->find($id);
    }
}
