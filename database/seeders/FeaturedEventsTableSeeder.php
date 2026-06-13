<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeaturedEvent;

class FeaturedEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => 'Live Music Night',
                'date' => '2025-08-15',
                'time' => '19:00',
                'location' => 'Cafe Katumiri Hall',
                'description' => 'Nikmati malam penuh musik dan suasana hangat bersama musisi lokal terbaik.',
                'image_url' => 'https://picsum.photos/600/400?random=21',
            ],
            [
                'event_name' => 'Cooking Class: Pasta Edition',
                'date' => '2025-08-20',
                'time' => '14:00',
                'location' => 'Dapur Utama Cafe Katumiri',
                'description' => 'Belajar langsung dari chef kami bagaimana membuat pasta autentik Italia.',
                'image_url' => 'https://picsum.photos/600/400?random=22',
            ],
            [
                'event_name' => 'Family Brunch Special',
                'date' => '2025-08-25',
                'time' => '10:00',
                'location' => 'Teras Taman Cafe Katumiri',
                'description' => 'Ajak keluarga menikmati brunch lezat dengan menu spesial dan suasana hangat.',
                'image_url' => 'https://picsum.photos/600/400?random=23',
            ],
        ];

        foreach ($events as $event) {
            FeaturedEvent::create($event);
        }
    }
}
