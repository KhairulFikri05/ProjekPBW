<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutStat>
 */
class AboutStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stat_number' => rand(1, 20) . '+',
            'stat_label' => 'Years of Experience',
            'order_number' => rand(1, 10),
        ];
    }
}
