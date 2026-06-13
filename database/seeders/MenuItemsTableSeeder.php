<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\MenuCategory;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID kategori berdasarkan nama
        $kategori = MenuCategory::pluck('id', 'name')->toArray();

        $menuItems = [
            [
                'category_id' => $kategori['Starters'] ?? 1,
                'name' => 'Bruschetta',
                'description' => 'Roti panggang dengan topping tomat segar, bawang putih, dan basil.',
                'price' => 35000,
                'image_url' => 'https://picsum.photos/500/300?random=1',
                'tags' => 'vegetarian,light',
                'is_featured' => true,
            ],
            [
                'category_id' => $kategori['Main Course'] ?? 1,
                'name' => 'Grilled Chicken Steak',
                'description' => 'Daging ayam panggang disajikan dengan saus lada hitam dan kentang tumbuk.',
                'price' => 75000,
                'image_url' => 'https://picsum.photos/500/300?random=2',
                'tags' => 'chicken,grill',
                'is_featured' => true,
            ],
            [
                'category_id' => $kategori['Desserts'] ?? 1,
                'name' => 'Chocolate Lava Cake',
                'description' => 'Kue coklat hangat dengan lelehan coklat di dalamnya, disajikan dengan es krim.',
                'price' => 45000,
                'image_url' => 'https://picsum.photos/500/300?random=3',
                'tags' => 'sweet,dessert',
                'is_featured' => false,
            ],
            [
                'category_id' => $kategori['Drinks'] ?? 1,
                'name' => 'Iced Matcha Latte',
                'description' => 'Minuman segar dari campuran matcha dan susu, disajikan dingin.',
                'price' => 30000,
                'image_url' => 'https://picsum.photos/500/300?random=4',
                'tags' => 'cold,matcha',
                'is_featured' => false,
            ],
            [
                'category_id' => $kategori['Main Course'] ?? 1,
                'name' => 'Salmon Teriyaki',
                'description' => 'Ikan salmon panggang dengan saus teriyaki spesial, disajikan dengan nasi dan sayur.',
                'price' => 95000,
                'image_url' => 'https://picsum.photos/500/300?random=5',
                'tags' => 'fish,japanese',
                'is_featured' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
