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
        $vehicleId = $request->query('vehicle_id'); // url query "?vehicle_id=123" => 123 contoh id vehicle yang digunakan untuk melihat laporan penjualan per kendaraan

        if($vehicleId) $vehicleId = new ObjectID($vehicleId);
        $data = $this->transactionService->allWithVehicle($vehicleId);

        return BaseResponse::success($data);
    }

    public function show($id)
    {
        $data = $this->transactionService->detail($id);

        if (!$data) {
            return BaseResponse::notFound('Transaction not found');
        }

        return BaseResponse::success($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $data = $this->transactionService->create($request->all());

        if (!$data) {
            return BaseResponse::error('Transaction failed!');
        }

        return BaseResponse::success($data);
    }
}
