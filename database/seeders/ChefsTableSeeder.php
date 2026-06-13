<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chef;

class ChefsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chefs = [
            [
                'name' => 'Chef Andi Pratama',
                'role' => 'Executive Chef',
                'bio' => 'Dengan pengalaman lebih dari 20 tahun, Chef Andi menghadirkan cita rasa khas yang memikat di setiap hidangan.',
                'image_url' => 'https://picsum.photos/400/500?random=10',
                'awards' => json_encode([
                    'Best Asian Cuisine 2018',
                    'Gold Medal Culinary Festival 2020'
                ]),
                'order_number' => 1,
            ],
            [
                'name' => 'Chef Lestari Widya',
                'role' => 'Pastry Chef',
                'bio' => 'Ahli dalam seni membuat dessert dengan tampilan memukau dan rasa yang menggoda.',
                'image_url' => 'https://picsum.photos/400/500?random=11',
                'awards' => json_encode([
                    'Top Pastry Innovator 2019'
                ]),
                'order_number' => 2,
            ],
            [
                'name' => 'Chef Rio Santoso',
                'role' => 'Sous Chef',
                'bio' => 'Chef muda berbakat yang terus mengeksplorasi teknik memasak modern dan tradisional.',
                'image_url' => 'https://picsum.photos/400/500?random=12',
                'awards' => json_encode([]), // tidak ada award
                'order_number' => 3,
            ],
        ];

        foreach ($chefs as $chef) {
            Chef::create($chef);
        }
    }
}
