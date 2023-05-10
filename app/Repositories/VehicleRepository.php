<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Models\Car;
use App\Models\Motor;

class VehicleRepository extends BaseRepository
{
    public function __construct(Vehicle $vehicle)
    {
        parent::__construct($vehicle);
    }

    public function getVehiclesWithMotorsAndCars()
    {
        return $this->model->with('vehicle')->get();
    }


    /**
     * Create a new vehicle.
     *
     * @param array $data
     * @param string $type The type of vehicle to create (car or motor)
     * @return \App\Models\Vehicle
     */
    public function create(array $data)
    {
        if ($data['type'] == 'car') {
            $child = new Car($data['vehicle']);
        } else if ($data['type'] == 'motor') {
            $child = new Motor($data['vehicle']);
        }else{
            throw new \Exception('Invalid vehicle type');
        }
        $child->save();

        unset($data['vehicle']);
        $vehicle = $this->model->create($data);
        $vehicle->vehicle()->associate($child);
        $vehicle->save();


        return $vehicle;
    }

    /**
     * Get all vehicles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a vehicle by ID.
     *
     * @param int $id
     * @return \App\Models\Vehicle|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update a vehicle.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        $vehicle = $this->model->find($id);

        if ($vehicle) {
            $vehicle->update($data);
            return true;
        }

        return false;
    }

    /**
     * Decrement the stock of a vehicle.
     *
     * @param int $id
     * @param int $quantity
     * @return bool
     */
    public function decrementStock($id, $quantity = 1)
    {
        $vehicle = $this->model->find($id);

        if ($vehicle && $vehicle->stock >= $quantity) {
            $vehicle->decrement('stock', $quantity);
            return true;
        }

        return false;
    }

    public function delete($vehicleId)
    {
        $vehicle = $this->model->find($vehicleId);
        $vehicle->delete();
    }
}
