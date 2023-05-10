<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = ['engine', 'suspension_type', 'transmission_type'];

    public function vehicle()
    {
        return $this->morphOne(Vehicle::class, 'vehicle');
    }
}
