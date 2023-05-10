<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['engine', 'passenger_capacity', 'type'];

    public function vehicle()
    {
        return $this->morphOne(Vehicle::class, 'vehicle');
    }
}
