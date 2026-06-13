<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => \App\Models\MenuCategory::factory(),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => rand(10, 100) . '.00',
            'image_url' => ' https://picsum.photos/400/300?random=' . rand(1, 100),
            'tags' => 'Vegan, Gluten-Free',
            'is_featured' => rand(0, 1),
        ];
    }
}
