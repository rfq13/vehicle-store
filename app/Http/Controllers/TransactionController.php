<?php

namespace App\Http\Controllers;

use App\Http\Response\BaseResponse;
use App\Services\TransactionServiceInterface;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $vehicleId = $request->query('vehicle_id');

        if($vehicleId) $vehicleId = new ObjectID($vehicleId);
        $data = $this->transactionService->allWithVehicle($vehicleId);

        return BaseResponse::success($data, $data->count());
    }

    public function show($id)
    {
        $data = $this->transactionService->detail($id);

        if (!$data) {
            return BaseResponse::notFound('Transaction not found');
        }

        return BaseResponse::success($data, 1);
    }
}
