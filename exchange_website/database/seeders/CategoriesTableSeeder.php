<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'Electronics', 'discount_rate' => 10, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Furniture', 'discount_rate' => 5, 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vehicles', 'discount_rate' => 15, 'status' => 'rejected', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mobiles', 'discount_rate' => 8, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion', 'discount_rate' => 12, 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
