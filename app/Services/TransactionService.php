<?php
namespace App\Services;

use App\Repositories\TransactionRepository;


interface TransactionServiceInterface
{
    public function detail($code);
    public function allWithVehicle();
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
        if ($vehileId) {
            return $this->TransactionRepo->getTransactionByVehicleId($vehileId);
        }
        return $this->TransactionRepo->getAllWithVehicle();
    }
}
