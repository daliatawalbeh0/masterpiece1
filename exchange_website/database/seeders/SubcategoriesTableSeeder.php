<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subcategories')->insert([
            // Electronics (category_id: 1)
            ['name' => 'Phones', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laptops', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TVs', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cameras', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Furniture (category_id: 2)
            ['name' => 'Tables', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chairs', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sofas', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beds', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Vehicles (category_id: 3)
            ['name' => 'Cars', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bikes', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trucks', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Motorcycles', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Mobiles (category_id: 4)
            ['name' => 'Smartphones', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Feature Phones', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tablets', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accessories', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Fashion (category_id: 5)
            ['name' => 'Clothes', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shoes', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bags', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accessories', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
