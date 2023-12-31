<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_id', 'user_id', 'rental_duration'
    ];

    public function vehicle(){
        return $this->belongsTo(\App\Models\Vehicle::class);
    }

    public function user(){
        return $this->hasOne(\App\Models\User::class);
    }
}
