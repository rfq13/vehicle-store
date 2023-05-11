<?php

namespace App\Repositories;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    public function getTransactionByCodeOrIdWithVehicle($code)
    {
        return $this->model->where('code', $code)->orWhere('_id', $code)->with('vehicle.vehicle')->first();
    }

    public function getAllWithVehicle($cond = [])
    {
        return $this->model->where($cond)->with('vehicle.vehicle')->get();
    }
}
