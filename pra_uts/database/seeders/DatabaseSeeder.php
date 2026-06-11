<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]
        );

        // Buat user biasa
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Biasa',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        // Buat kategori
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Produk elektronik dan gadget'],
            ['name' => 'Gaming', 'description' => 'Peralatan gaming dan aksesori'],
            ['name' => 'Aksesoris', 'description' => 'Aksesori dan perlengkapan'],
            ['name' => 'Fashion', 'description' => 'Pakaian dan fashion'],
            ['name' => 'Olahraga', 'description' => 'Peralatan olahraga'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Panggil ProductSeeder
        $this->call(ProductSeeder::class);
    }
}
