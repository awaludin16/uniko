<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'category_id' => 2,
                'name' => 'Cappuccino',
                'price' => 25000,
                'description' => 'Kopi susu dengan foam lembut di atasnya.',
                'image' => 'cappucino-selber-machen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Spesial',
                'price' => 35000,
                'description' => 'Nasi goreng dengan topping telur, ayam, dan kerupuk.',
                'image' => 'OIP.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Matcha Latte',
                'price' => 27000,
                'description' => 'Minuman teh hijau dengan susu dan rasa manis lembut.',
                'image' => 'hot-and-iced-matcha-latte-3-1024x1536.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'French Fries',
                'price' => 18000,
                'description' => 'Kentang goreng renyah disajikan dengan saus.',
                'image' => 'Kentang-goreng.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Es Teh Manis',
                'price' => 8000,
                'description' => 'Teh segar dengan tambahan gula batu dan es.',
                'image' => 'Gambar-Es-Teh-Manis-6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
