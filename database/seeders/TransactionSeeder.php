<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectID;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // get all from vehicle
    public function run()
    {
        $vehicles = Vehicle::select('_id')->get();

        // get random vehicle id
        $vehicleIds = $vehicles->map(function ($vehicle) {
            return $vehicle->_id;
        });

        $transactions = [
            [
                'price' => 500000000,
                'code' => 'TRX-2021-01',
                'quantity' => 1,
                'vehicle_id' => new ObjectID($vehicleIds->random()),
            ],
            [
                'price' => 50000000,
                'code' => 'TRX-2021-02',
                'quantity' => 1,
                'vehicle_id' => new ObjectID($vehicleIds->random()),
            ]
        ];

        foreach ($transactions as $transaction){
            \App\Models\Transaction::create($transaction);
        }

    }

    public function down()
    {
        \App\Models\Transaction::truncate();
    }
}
