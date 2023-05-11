<?php

namespace Tests\Feature;

use Tests\TestCase;
use \App\Models\User;
use JWTAuth;

class TransactionTest extends TestCase
{
    /**
     * Get all transactions
     *
     * @return void
     */
    public function testGetAllTransactions()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->json('GET', '/api/transaction');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    '_id',
                    'price',
                    'code',
                    'quantity',
                    'vehicle_id',
                    'created_at',
                    'updated_at',
                    'vehicle' => [
                        '_id',
                        'color',
                        'year',
                        'price',
                        'stock',
                        'type',
                        'created_at',
                        'updated_at',
                        'vehicle'
                    ]
                ]
            ],
            'success',
            'message',
            'total'
        ]);
    }

    /**
     * Get detail transaction
     *
     * @return void
     */
    public function testGetDetailTransaction()
    {
        $user = User::first();
        $trx = \App\Models\Transaction::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->json('GET', '/api/transaction/'. $trx->_id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '_id',
                'price',
                'code',
                'quantity',
                'vehicle_id',
                'created_at',
                'updated_at',
                'vehicle' => [
                    '_id',
                    'color',
                    'year',
                    'price',
                    'stock',
                    'type',
                    'created_at',
                    'updated_at',
                    'vehicle'
                ]
            ],
            'success',
            'message',
            'total'
        ]);
    }

    /**
     * Create transaction
     *
     * @return void
     */
    public function testCreateTransaction(){
        $user = User::first();
        $vehicle = \App\Models\Vehicle::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->json('POST', '/api/transaction',[
            'quantity' => 1,
            'vehicle_id' => $vehicle->_id
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '_id',
                'price',
                'code',
                'quantity',
                'vehicle_id',
                'created_at',
                'updated_at',
            ],
            'success',
            'message',
            'total'
        ]);
    }

}
