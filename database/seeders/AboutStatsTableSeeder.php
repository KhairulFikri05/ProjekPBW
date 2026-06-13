<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutStat;

class AboutStatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stats = [
            [
                'stat_number' => 15,
                'stat_label' => 'Tahun Pengalaman',
                'order_number' => 1,
            ],
            [
                'stat_number' => 2500,
                'stat_label' => 'Pelanggan Puas',
                'order_number' => 2,
            ],
            [
                'stat_number' => 120,
                'stat_label' => 'Menu Tersedia',
                'order_number' => 3,
            ],
            [
                'stat_number' => 25,
                'stat_label' => 'Penghargaan',
                'order_number' => 4,
            ],
        ];

        foreach ($stats as $stat) {
            AboutStat::create($stat);
        }
    }
}
