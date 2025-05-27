<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Foods', 'Drinks', 'Snacks'];
        foreach ($kategori as $item) {
            Category::create(['name_category' => $item]);
        }
    }
}
