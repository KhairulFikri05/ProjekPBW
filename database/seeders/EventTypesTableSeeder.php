<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            [
                'name' => 'Wedding',
                'capacity' => 100,
                'description' => 'Rayakan hari bahagiamu bersama kami!',
                'icon_class' => 'bi-calendar-event',
            ],
            [
                'name' => 'Corporate',
                'capacity' => 50,
                'description' => 'Cocok untuk acara bisnis atau gathering perusahaan.',
                'icon_class' => 'bi-briefcase',
            ],
            [
                'name' => 'Birthday Party',
                'capacity' => 30,
                'description' => 'Buat pesta ulang tahunmu jadi lebih spesial.',
                'icon_class' => 'bi-gift',
            ],
        ];

        foreach ($eventTypes as $type) {
            EventType::create($type);
        }
    }
}
