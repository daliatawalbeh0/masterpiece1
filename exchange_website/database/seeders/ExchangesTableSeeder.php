<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exchange;

class ExchangesTableSeeder extends Seeder
{
    public function run()
    {
        Exchange::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'item_id' => 1,
            'offered_item_id' => 2,
            'status' => 'pending',
        ]);

        Exchange::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'item_id' => 2,
            'offered_item_id' => 1,
            'status' => 'accepted',
        ]);
    }
}
