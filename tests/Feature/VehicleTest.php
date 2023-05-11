<?php

namespace Tests\Feature;

use \App\Models\User;
use JWTAuth;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetStock()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->json('GET', '/api/vehicle');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
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
}
