<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Motor;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'color' => 'Black',
                'stock' => 10,
                'year' => 2021,
                'price' => 500000000,
                'type' => 'car',
                'vehicle' => [
                    'engine' => 'V6',
                    'passenger_capacity' => 5,
                    'type' => 'SUV'
                ]
            ],
            [
                'color' => 'Red',
                'stock' => 10,
                'year' => 2021,
                'price' => 50000000,
                'type' => 'motor',
                'vehicle' => [
                    'engine' => '250cc',
                    'suspension_type' => 'Upside Down',
                    'transmission_type' => 'Manual'
                ]
            ]
        ];

        foreach ($vehicles as $vehicle) {
            $vehicleModel = new Vehicle();
            $vehicleModel->color = $vehicle['color'];
            $vehicleModel->stock = $vehicle['stock'];
            $vehicleModel->year = $vehicle['year'];
            $vehicleModel->price = $vehicle['price'];
            $vehicleModel->type = $vehicle['type'];

            if ($vehicle['type'] == 'car') {
                $car = new Car($vehicle['vehicle']);
                $car->save();
                $vehicleModel->vehicle()->associate($car);
            } else {
                $motor = new Motor($vehicle['vehicle']);
                $motor->save();
                $vehicleModel->vehicle()->associate($motor);
            }

            $vehicleModel->save();
        }
    }
}
