<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeaturedEvent>
 */
class FeaturedEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_name' => 'Wedding Party',
            'date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'time' => '19:00 - 22:00',
            'location' => 'Cafe Katumiri Hall',
            'description' => fake()->paragraph(),
            'image_url' => ' https://picsum.photos/600/400?random=' . rand(1, 100),
        ];
    }
}
