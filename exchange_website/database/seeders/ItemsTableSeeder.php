<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        Item::create([
            'user_id' => 1,
            'subcategory_id' => 1,
            'category_id' => 1,
            'title' => 'Laptop',
            'description' => 'A slightly used laptop in excellent condition.',
            'price' => 500,
            'condition' => 'good',
            'usage_duration' => 1,
            'image' => 'laptop.jpg',
            'status' => 'approved',
            'is_exchange_specific' => false,
            'desired_item_id' => null,
            'desired_item_category' => null,
            'desired_item_subcategory' => null,
            'desired_item_description' => null,
            'show' => true,
        ]);

        Item::create([
            'user_id' => 2,
            'subcategory_id' => 2,
            'category_id' => 1,
            'title' => 'Phone',
            'description' => 'Brand new phone.',
            'price' => 300,
            'condition' => 'new',
            'usage_duration' => 0,
            'image' => 'phone.jpg',
            'status' => 'approved',
            'is_exchange_specific' => false,
            'desired_item_id' => null,
            'desired_item_category' => null,
            'desired_item_subcategory' => null,
            'desired_item_description' => null,
            'show' => true,
        ]);
    }
}
