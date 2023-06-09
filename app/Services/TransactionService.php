<?php
namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\VehicleRepository;
use App\Models\Vehicle;


interface TransactionServiceInterface
{
    public function detail($code);
    public function allWithVehicle();
    public function create($data);
}

class TransactionService implements TransactionServiceInterface
{
    private $TransactionRepo;

    public function __construct(TransactionRepository $TransactionRepo)
    {
        $this->TransactionRepo = $TransactionRepo;
    }

    public function detail($code)
    {
        return $this->TransactionRepo->getTransactionByCodeOrIdWithVehicle($code);
    }

    public function allWithVehicle($vehileId = null)
    {
        $cond = [];
        if ($vehileId) {
            $cond['vehicle_id'] = $vehileId;
        }
        return $this->TransactionRepo->getAllWithVehicle($cond);
    }

    // pembelian baru
    public function create($data)
    {
        $vehicleRepo = new VehicleRepository(new Vehicle);
        $vehicle = $vehicleRepo->find($data['vehicle_id']);
        if (!$vehicle) {
            return false;
        }

        $data['price'] = $vehicle->price;
        $data['total'] = $vehicle->price * $data['quantity'];
        $data['code'] = $this->generateCode();
        $data['vehicle_id'] = $vehicle->_id;

        $transaction = $this->TransactionRepo->create($data);

        if (!$transaction) {
            return false;
        }

        $vehicleRepo->decrementStock($data['vehicle_id'], $data['quantity']);

        return $transaction;
    }

    public function generateCode()
    {
        $code = 'TRX' . date('Ymd') . rand(1000, 9999);

        $transaction = $this->detail($code);

        if ($transaction) {
            return $this->generateCode();
        }

        return $code;
    }
}
