<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['price', 'code', 'quantity', 'vehicle_id'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', '_id');
    }
}
