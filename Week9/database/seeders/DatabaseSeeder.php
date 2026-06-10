<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // Buat akun Admin
        // =============================================
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin Risol',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // =============================================
        // Buat akun User biasa
        // =============================================
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'     => 'User Biasa',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ]
        );

        // =============================================
        // Buat 6 produk awal
        // =============================================
        $products = [
            [
                'name'        => 'Risol Matcha Premium',
                'varian'      => 'Matcha',
                'price'       => 12000,
                'stock'       => 85,
                'image'       => null,
                'description' => 'Isian matcha berkualitas tinggi yang memberikan cita rasa unik dan menyegarkan.',
            ],
            [
                'name'        => 'Risol Coklat Lezat',
                'varian'      => 'Coklat',
                'price'       => 12000,
                'stock'       => 120,
                'image'       => null,
                'description' => 'Isian coklat yang kaya dan lezat, menciptakan kelezatan yang tak terlupakan.',
            ],
            [
                'name'        => 'Risol Bolognese Istimewa',
                'varian'      => 'Bolognese',
                'price'       => 14000,
                'stock'       => 95,
                'image'       => null,
                'description' => 'Risol gurih dengan isian daging sapi empuk berkualitas dengan bumbu autentik khas Italia.',
            ],
            [
                'name'        => 'Risol Mozzarella Keju',
                'varian'      => 'Mozzarella',
                'price'       => 15000,
                'stock'       => 110,
                'image'       => null,
                'description' => 'Keju mozzarella yang melumer sempurna, menciptakan tekstur unik dan pengalaman rasa luar biasa.',
            ],
            [
                'name'        => 'Risol Beef Premium',
                'varian'      => 'Beef',
                'price'       => 16000,
                'stock'       => 75,
                'image'       => null,
                'description' => 'Daging sapi pilihan premium, empuk dan berkualitas tinggi untuk kepuasan rasa maksimal.',
            ],
            [
                'name'        => 'Risol Tiramisu Manis',
                'varian'      => 'Tiramisu',
                'price'       => 13000,
                'stock'       => 105,
                'image'       => null,
                'description' => 'Perpaduan manis tiramisu dan cita rasa tradisional risol — kolaborasi rasa yang tak terduga.',
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['name' => $p['name']], $p);
        }
    }
}