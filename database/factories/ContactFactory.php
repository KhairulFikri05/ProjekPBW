<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email_1' => 'info@cafe-katumiri.com',
            'email_2' => 'support@cafe-katumiri.com',
            'phone' => '+1234567890',
            'address' => fake()->address(),
            'office_hours' => "Mon-Fri: 9 AM - 5 PM",
        ];
    }
}
