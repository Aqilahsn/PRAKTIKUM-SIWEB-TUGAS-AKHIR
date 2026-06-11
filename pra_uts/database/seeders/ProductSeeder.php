<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data produk dengan kategori
        $products = [
            [
                'name' => 'Laptop Gaming ASUS ROG',
                'description' => 'Laptop gaming dengan spesifikasi tinggi, RTX 4060, Intel i7, performa maksimal untuk gaming',
                'price' => 15000000,
                'stock' => 5,
                'categories' => ['Elektronik', 'Gaming'],
            ],
            [
                'name' => 'Mouse Gaming Razer DeathAdder',
                'description' => 'Mouse gaming dengan sensor presisi tinggi, ergonomis, dan LED RGB',
                'price' => 450000,
                'stock' => 20,
                'categories' => ['Gaming', 'Aksesoris'],
            ],
            [
                'name' => 'Keyboard Mechanical RGB',
                'description' => 'Keyboard mechanical dengan switch Cherry MX, RGB lighting, cocok untuk gaming dan typing',
                'price' => 800000,
                'stock' => 15,
                'categories' => ['Gaming', 'Aksesoris'],
            ],
            [
                'name' => 'Headset Gaming Sennheiser',
                'description' => 'Headset gaming dengan audio surround 7.1, mikrofon noise canceling',
                'price' => 1200000,
                'stock' => 10,
                'categories' => ['Gaming', 'Elektronik'],
            ],
            [
                'name' => 'Monitor 27 inch 165Hz',
                'description' => 'Monitor gaming 27 inch dengan refresh rate 165Hz, response time 1ms',
                'price' => 3500000,
                'stock' => 8,
                'categories' => ['Gaming', 'Elektronik'],
            ],
            [
                'name' => 'Smartphone Samsung Galaxy S23',
                'description' => 'Smartphone flagship dengan prosesor terbaru, kamera 50MP, layar AMOLED 120Hz',
                'price' => 9000000,
                'stock' => 12,
                'categories' => ['Elektronik'],
            ],
            [
                'name' => 'Powerbank 20000mAh',
                'description' => 'Powerbank kapasitas besar dengan fast charging, support charging 3 device sekaligus',
                'price' => 250000,
                'stock' => 30,
                'categories' => ['Elektronik', 'Aksesoris'],
            ],
            [
                'name' => 'Webcam Logitech 4K',
                'description' => 'Webcam 4K dengan autofocus, microphone built-in, sempurna untuk streaming',
                'price' => 1500000,
                'stock' => 7,
                'categories' => ['Elektronik', 'Gaming'],
            ],
            [
                'name' => 'Sepatu Olahraga Nike Air Max',
                'description' => 'Sepatu olahraga nyaman dengan teknologi Air Max cushioning',
                'price' => 1200000,
                'stock' => 25,
                'categories' => ['Olahraga', 'Fashion'],
            ],
            [
                'name' => 'Jersey Manchester United Official',
                'description' => 'Jersey official Manchester United musim terbaru, material breathable',
                'price' => 450000,
                'stock' => 40,
                'categories' => ['Fashion', 'Olahraga'],
            ],
            [
                'name' => 'Tas Gaming Laptop 15 inch',
                'description' => 'Tas gaming dengan kompartemen padding, water-resistant, kapasitas besar',
                'price' => 350000,
                'stock' => 18,
                'categories' => ['Gaming', 'Aksesoris'],
            ],
            [
                'name' => 'SSD NVMe 1TB Samsung 970',
                'description' => 'SSD NVMe ultra cepat dengan kecepatan baca hingga 7000MB/s',
                'price' => 1000000,
                'stock' => 20,
                'categories' => ['Elektronik'],
            ],
            [
                'name' => 'RAM DDR5 32GB Corsair',
                'description' => 'RAM DDR5 kapasitas 32GB dengan kecepatan tinggi untuk gaming dan workstation',
                'price' => 1800000,
                'stock' => 10,
                'categories' => ['Elektronik'],
            ],
            [
                'name' => 'GPU RTX 4070 Ti',
                'description' => 'Kartu grafis high-end untuk gaming dan creative work dengan performa maksimal',
                'price' => 12000000,
                'stock' => 3,
                'categories' => ['Elektronik', 'Gaming'],
            ],
            [
                'name' => 'Smartwatch Apple Watch Series 9',
                'description' => 'Smartwatch premium dengan health monitoring, fitness tracking, dan always-on display',
                'price' => 4500000,
                'stock' => 6,
                'categories' => ['Elektronik'],
            ],
        ];

        foreach ($products as $productData) {
            $categories = $productData['categories'];
            unset($productData['categories']);

            $product = Product::firstOrCreate(
                ['name' => $productData['name']],
                $productData
            );

            // Attach categories
            foreach ($categories as $categoryName) {
                $category = Category::where('name', $categoryName)->first();
                if ($category) {
                    $product->categories()->syncWithoutDetaching($category->id);
                }
            }
        }
    }
}
