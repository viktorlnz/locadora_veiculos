<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleDescritive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::factory(100)->create();
    }
}
