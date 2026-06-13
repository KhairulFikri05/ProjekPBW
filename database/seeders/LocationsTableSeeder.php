<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'address' => 'Jl. Raya No. 123, Bandung, Indonesia',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.093649236475!2d144.95373531532974!3d-37.81721397975265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d9b5a40c8c0!2sFederation%20Square!5e0!3m2!1sen!2sid!4v1631069127958!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'hours' => "Senin - Jumat: 10.00 - 22.00\nSabtu - Minggu: 09.00 - 23.00",
            'contact_phone' => '+62 812 3456 7890',
        ]);
    }
}
