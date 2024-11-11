<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'content' => 'Hello, interested in your item!',
            'image' => null,
            'is_read' => false,
        ]);

        Message::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'content' => 'Sure, let’s discuss further.',
            'image' => null,
            'is_read' => true,
        ]);
    }
}
