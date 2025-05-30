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
                'name' => 'Americano',
                'price' => 15000,
                'description' => 'Satu hingga 10 teguk espresso dan delapan hingga 12 ons air panas.',
                'image' => 'iced-americano-6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Pisang Goreng Keju',
                'price' => 17000,
                'description' => 'Pisang goreng renyah dengan taburan keju dan cokelat.',
                'image' => 'maxresdefault.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Risoles Mayo',
                'price' => 10000,
                'description' => 'Risoles dengan isian sosis dan mayones, dibalut tepung roti.',
                'image' => '62e35a47c7535.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Green Tea Latte',
                'price' => 23000,
                'description' => 'Latte hijau dengan aroma teh Jepang.',
                'image' => 'Starbucks-Iced-Matcha-Green-Tea-Latte-7-of-16.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Ayam Geprek + Sangu',
                'price' => 29000,
                'description' => 'Ayam goreng digeprek lalu ditambhain sangu',
                'image' => '10a71c00-230f-4161-8fba-4bf04489300f_722a1ba8-4b9c-4877-9896-bd70320a6f84_Go-Biz_20200419_203339.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Chocolate Milkshake',
                'price' => 22000,
                'description' => 'Milkshake cokelat dengan krim kocok di atasnya.',
                'image' => 'IMG_2377-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Mie Goreng Jawa',
                'price' => 27000,
                'description' => 'Mie goreng khas Jawa dengan rasa manis gurih.',
                'image' => 'mie-goreng-jawa-500x300.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
