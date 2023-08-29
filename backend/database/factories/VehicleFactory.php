<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\VehicleDescritive;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $imagePath = UploadedFile::fake()->image('vehicle'.fake()->number(1, 10000).'.jpg');

        $imagePath->move(storage_path('app/temp'), $imagePath->getClientOriginalName());

        $categoryIds = Category::pluck('id');

        $vehicleDescritive = VehicleDescritive::factory()->create();

        return [
            'plate' => fake()->regexify('[A-Z]{3}[0-9]{4}'),
            'brand' => fake()->word(),
            'model' => fake()->words(2, true),
            'img' => 'temp/' . $imagePath->getClientOriginalName(),
            'price' => fake()->randomFloat(2, 1, 9999.99),
            'category_id' => fake()->randomElement($categoryIds),
            'vehicle_descritive_id' => $vehicleDescritive->id
        ];
    }
}
