<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@example.com',
                'phone' => '+62 812 1111 1111',
                'date' => '2025-07-10',
                'time' => '18:30',
                'people' => 2,
                'message' => 'Meja dekat jendela jika memungkinkan.',
                'status' => 'Pending',
            ],
            [
                'name' => 'Siti Lestari',
                'email' => 'siti@example.com',
                'phone' => '+62 812 2222 2222',
                'date' => '2025-07-11',
                'time' => '19:00',
                'people' => 4,
                'message' => '',
                'status' => 'Pending',
            ],
            [
                'name' => 'Rio Santoso',
                'email' => 'rio@example.com',
                'phone' => '+62 812 3333 3333',
                'date' => '2025-07-12',
                'time' => '20:00',
                'people' => 3,
                'message' => 'Rayakan ulang tahun istri saya.',
                'status' => 'Pending',
            ],
            [
                'name' => 'Dewi Kusuma',
                'email' => 'dewi@example.com',
                'phone' => '+62 812 4444 4444',
                'date' => '2025-07-13',
                'time' => '17:00',
                'people' => 5,
                'message' => '',
                'status' => 'Pending',
            ],
            [
                'name' => 'Bayu Nugraha',
                'email' => 'bayu@example.com',
                'phone' => '+62 812 5555 5555',
                'date' => '2025-07-14',
                'time' => '19:30',
                'people' => 6,
                'message' => 'Mohon siapkan kursi bayi.',
                'status' => 'Pending',
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
