<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            TheUsersTableSeeder::class,
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            ItemsTableSeeder::class,
            ExchangesTableSeeder::class,
            MessagesTableSeeder::class,
            DonationsTableSeeder::class,
            AdminsTableSeeder::class,
        ]);
    }
}
