<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data testimonial.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Andi Pratama',
                'role' => 'Pengusaha',
                'message' => 'Tempat yang luar biasa! Makanannya enak dan pelayanannya sangat ramah. Pasti akan kembali lagi!',
                'rating' => 5,
                'image_url' => 'https://picsum.photos/100/100?random=1',
            ],
            [
                'name' => 'Siti Lestari',
                'role' => 'Desainer Interior',
                'message' => 'Suasana restorannya sangat nyaman. Cocok banget buat dinner romantis.',
                'rating' => 4,
                'image_url' => 'https://picsum.photos/100/100?random=2',
            ],
            [
                'name' => 'Bayu Nugraha',
                'role' => 'Dosen',
                'message' => 'Saya suka konsep dan presentasi makanannya. Sangat elegan!',
                'rating' => 5,
                'image_url' => 'https://picsum.photos/100/100?random=3',
            ],
            [
                'name' => 'Dewi Kusuma',
                'role' => 'Ibu Rumah Tangga',
                'message' => 'Anak-anak saya sangat suka dessert di sini. Pasti akan sering mampir!',
                'rating' => 4,
                'image_url' => 'https://picsum.photos/100/100?random=4',
            ],
            [
                'name' => 'Rian Kurniawan',
                'role' => 'Musisi',
                'message' => 'Live music dan makanannya bikin malam saya sempurna. Recommended banget!',
                'rating' => 5,
                'image_url' => 'https://picsum.photos/100/100?random=5',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
