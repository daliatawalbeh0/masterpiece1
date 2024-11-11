<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'image',
        'is_read'
    ];

    public function sender()
    {
        return $this->belongsTo(TheUser::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(TheUser::class, 'receiver_id');
    }
}
