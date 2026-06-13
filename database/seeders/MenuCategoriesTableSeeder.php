<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MenuCategory;

class MenuCategoriesTableSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk kategori menu.
     */
    public function run(): void
    {
        $categories = ['Starters', 'Main Course', 'Desserts', 'Drinks'];

        foreach ($categories as $category) {
            $slug = Str::slug($category);

            // Hindari duplikat berdasarkan slug
            if (!MenuCategory::where('slug', $slug)->exists()) {
                MenuCategory::create([
                    'name' => $category,
                    'slug' => $slug,
                ]);
            }
        }
    }
}
