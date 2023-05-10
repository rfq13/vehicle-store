<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['color', 'year', 'price','stock','type'];

    public function vehicle()
    {
        return $this->morphTo();
    }
}
