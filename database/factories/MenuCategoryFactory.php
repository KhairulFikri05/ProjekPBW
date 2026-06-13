<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuCategory>
 */
class MenuCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => function () {
                // Menggunakan kalimat pendek sebagai ganti word()
                return ucwords(fake()->words(2, true)); // contoh: "Grilled Chicken"
            },
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ];
    }
}
