<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDescritive extends Model
{
    use HasFactory;

    protected $fillable = [
        'color', 'ports', 'transmission'
    ];

    public function vehicle(){
        return $this->hasOne(Vehicle::class);
    }
}
