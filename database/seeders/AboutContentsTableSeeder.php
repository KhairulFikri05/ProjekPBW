<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutContent;

class AboutContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutContent::create([
            'title' => 'Perjalanan Kuliner Kami',
            'description' => 'Kami membawa pengalaman kuliner terbaik dengan bahan-bahan segar dan koki yang penuh gairah.',
            'chef_quote' => 'Memasak adalah seni, dan kami adalah pelukisnya.',
            'chef_image' => 'https://picsum.photos/400/500?random=1',
            'establishment_year' => 2008,
        ]);
    }
}
