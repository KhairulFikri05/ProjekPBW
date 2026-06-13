<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutContent>
 */
class AboutContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Our Culinary Journey',
            'description' => fake()->paragraphs(3, true),
            'chef_quote' => 'Good food is the foundation of genuine happiness.',
            'chef_image' => ' https://picsum.photos/400/500?random=' . rand(1, 100),
            'establishment_year' => rand(1990, 2010),
        ];
    }
}
