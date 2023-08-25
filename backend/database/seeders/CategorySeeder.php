<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Hatche'
        ]);

        Category::factory()->create([
            'name' => 'Sedan'
        ]);

        Category::factory()->create([
            'name' => 'SUV'
        ]);

        Category::factory()->create([
            'name' => 'Pickup'
        ]);
    }
}
