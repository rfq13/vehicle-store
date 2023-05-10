<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\User;
use JWTAuth;

class TransactionTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
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
    }
}
