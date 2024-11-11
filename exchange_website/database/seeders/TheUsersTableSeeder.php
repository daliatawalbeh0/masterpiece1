<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TheUsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('theusers')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '123456789',
                'address' => '123 Main St',
                'role_id' => 1, // assuming 1 is the admin role
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '987654321',
                'address' => '456 Side St',
                'role_id' => 2, // assuming 2 is the user role
            ]
        ]);
    }
}
