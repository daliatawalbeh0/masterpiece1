<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationsTableSeeder extends Seeder
{
    public function run()
    {
        Donation::create([
            'donor_id' => 1,
            'image' => 'donation1.jpg',
            'description' => 'Donation for a good cause.',
            'item_title' => 'Laptop Donation',
            'status' => 'pending',
        ]);

        Donation::create([
            'donor_id' => 2,
            'image' => 'donation2.jpg',
            'description' => 'Donation for another cause.',
            'item_title' => 'Phone Donation',
            'status' => 'approved',
        ]);
    }
}
