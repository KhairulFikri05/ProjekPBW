<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chef>
 */
class ChefFactory extends Factory
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
            'role' => 'Executive Chef',
            'bio' => fake()->paragraph(),
            'image_url' => ' https://picsum.photos/400/500?random=' . rand(1, 100),
            'awards' => json_encode(['Best Chef 2022', 'Top 10 Foodie']),
            'order_number' => rand(1, 10),
        ];
    }
}
