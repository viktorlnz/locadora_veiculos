<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehiclesNotRented = \App\Models\Vehicle::whereDoesntHave('rent')->pluck('id');
        $users = \App\Models\User::where('category', '<>', 'ADMIN')->pluck('id');

        $startOfYear = now()->startOfYear();
        $dtCreated = fake()->dateTimeBetween($startOfYear, now());
        $deletedAt = fake()->boolean() ? fake()->dateTimeBetween($dtCreated, now()) : null;

        return [
            'vehicle_id' => fake()->randomElement($vehiclesNotRented),
            'user_id' => fake()->randomElement($users),
            'rental_duration' => fake()->randomElement([30, 60, 90, 180]),
            'created_at' => $dtCreated,
            'deleted_at' => $deletedAt
        ];
    }
}
