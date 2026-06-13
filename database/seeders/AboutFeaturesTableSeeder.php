<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutFeature;

class AboutFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'icon_class' => 'bi-star',
                'title' => 'Bahan Berkualitas',
                'description' => 'Kami hanya menggunakan bahan-bahan segar dan berkualitas tinggi dalam setiap hidangan.',
            ],
            [
                'icon_class' => 'bi-people',
                'title' => 'Pelayanan Ramah',
                'description' => 'Staf kami siap menyambut Anda dengan senyuman dan pelayanan terbaik.',
            ],
            [
                'icon_class' => 'bi-heart',
                'title' => 'Rasa yang Tak Terlupakan',
                'description' => 'Setiap gigitan dirancang untuk menciptakan kenangan kuliner yang istimewa.',
            ],
        ];

        foreach ($features as $feature) {
            AboutFeature::create($feature);
        }
    }
}
