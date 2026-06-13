<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->address(),
            'map_embed' => '<iframe src=" https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.093649236475!2d144.95373531532974!3d-37.81721397975265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d9b5a40c8c0!2sFederation%20Square!5e0!3m2!1sen!2sid!4v1631069127958!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'hours' => "Mon-Fri: 10 AM - 10 PM\nSat-Sun: 9 AM - 11 PM",
            'contact_phone' => '+1234567890',
        ];
    }
}
