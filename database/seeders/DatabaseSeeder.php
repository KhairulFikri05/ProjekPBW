<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin secara manual
        User::factory()->create([
            'name' => 'Admin Kape Cihanjuang',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@example.com'), // password: password
            'remember_token' => Str::random(10),
        ]);

        // Jalankan semua seeder lainnya
        $this->call([
            HeroSlidersTableSeeder::class,
            AboutContentsTableSeeder::class,
            AboutFeaturesTableSeeder::class,
            AboutStatsTableSeeder::class,
            MenuCategoriesTableSeeder::class,
            MenuItemsTableSeeder::class,
            TestimonialsTableSeeder::class,
            ChefsTableSeeder::class,
            ReservationsTableSeeder::class,
            LocationsTableSeeder::class,
            EventTypesTableSeeder::class,
            FeaturedEventsTableSeeder::class,
            ContactsTableSeeder::class,
        ]);
    }
}
