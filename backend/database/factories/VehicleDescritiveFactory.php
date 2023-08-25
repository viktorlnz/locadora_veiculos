<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleDescritiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'color' => fake()->colorName(),
            'ports' => fake()->numberBetween(0, 12),
            'transmission' => fake()->randomElement(['Manual', 'Automatizada', 'Automática'])
        ];
    }
}
