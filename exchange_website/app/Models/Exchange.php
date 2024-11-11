<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'item_id',
        'offered_item_id',
        'status'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function offeredItem()
    {
        return $this->belongsTo(Item::class, 'offered_item_id');
    }

    public function user()
    {
        return $this->belongsTo(TheUser::class, 'user_id');
    }

    public function offeredUser()
    {
        return $this->belongsTo(TheUser::class, 'offered_user_id');
    }
    public function requestedItem()
    {
        return $this->belongsTo(Item::class, 'requested_item_id');
    }
    public function sender()
    {
        return $this->belongsTo(TheUser::class, 'sender_id');
    }

    // Relationship to get the user who received the exchange request
    public function receiver()
    {
        return $this->belongsTo(TheUser::class, 'receiver_id');
    }
}
