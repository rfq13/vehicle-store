<?php

namespace App\Repositories;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    public function getTransactionByVehicleId($vehicleId)
    {
        return $this->model->where('vehicle_id', $vehicleId)->with('vehicle')->get();
    }

    public function getTransactionByCodeOrIdWithVehicle($code)
    {
        return $this->model->where('code', $code)->orWhere('_id', $code)->with('vehicle')->first();
    }

    public function getAllWithVehicle()
    {
        return $this->model->with('vehicle')->get();
    }
}
