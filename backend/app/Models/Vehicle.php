<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;


    public function vehicleDescritive(){
        return $this->hasOne(VehicleDescritive::class);
    }

    public function category(){
        return $this->hasOne(Category::class);
    }

    public function rent(){
        return $this->hasMany(\App\Models\Rent::class);
    }
}
