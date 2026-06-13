<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutFeature>
 */
class AboutFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon_class' => 'bi-award',
            'title' => 'Award Winning',
            'description' => fake()->paragraph(),
            'order_number' => rand(1, 10),
        ];
    }
}
