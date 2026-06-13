<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeroSlider>
 */
class HeroSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image_url' => 'https://picsum.photos/800/600?random=' . rand(1, 100),
            'button_text' => 'Order Now',
            'button_link' => '/menu',
            'order_number' => rand(1, 10),
            'is_active' => true,
        ];
    }
}
