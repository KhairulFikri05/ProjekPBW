<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlider;

class HeroSlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Selamat Datang di Kape Cihanjuang',
                'description' => 'Nikmati pengalaman kuliner terbaik dengan pemandangan indah dan hidangan lezat.',
                'image_url' => 'https://picsum.photos/1200/600?random=1',
                'button_text' => 'Lihat Menu',
                'button_link' => '#menu',
                'order_number' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Reservasi Mudah dan Cepat',
                'description' => 'Pesan meja Anda secara online dan rasakan kenyamanan dalam setiap kunjungan.',
                'image_url' => 'https://picsum.photos/1200/600?random=2',
                'button_text' => 'Pesan Sekarang',
                'button_link' => '#reservation',
                'order_number' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Acara Spesial di Tempat Kami',
                'description' => 'Rayakan momen istimewa bersama keluarga dan sahabat di Cafe Katumiri.',
                'image_url' => 'https://picsum.photos/1200/600?random=3',
                'button_text' => 'Lihat Event',
                'button_link' => '#events',
                'order_number' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            HeroSlider::create($slider);
        }
    }
}
