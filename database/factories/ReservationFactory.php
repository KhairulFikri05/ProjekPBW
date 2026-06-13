<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => '+1234567890',
            'people' => rand(1, 10),
            'date' => fake()->date(),
            'time' => fake()->time('H:i'),
            'message' => fake()->sentence(),
            'status' => 'Pending',
        ];
    }
}
