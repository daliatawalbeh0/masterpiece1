<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TheUser extends Authenticatable
{
    use HasFactory, Notifiable;

    // تحديد اسم الجدول
    protected $table = 'theusers';

    // الأعمدة التي يمكن تعبئتها
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'role_id', // تأكد من وجود هذا العمود في الجدول
    ];

    // الأعمدة التي يجب إخفاؤها
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * علاقة المستخدم بالدور.
     * كل مستخدم ينتمي إلى دور واحد في جدول roles.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * علاقة المستخدم بالعناصر التي يمتلكها.
     * علاقة المستخدم مع جدول items.
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    // علاقات أخرى (اختياري):
    public function exchanges()
    {
        return $this->hasMany(Exchange::class, 'user_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function donationsAsDonor()
    {
        return $this->hasMany(Donation::class, 'donor_id');
    }

    public function donationsAsReceiver()
    {
        return $this->hasMany(Donation::class, 'receiver_id');
    }

    public function sentExchanges()
    {
        return $this->hasMany(Exchange::class, 'sender_id');
    }

    public function receivedExchanges()
    {
        return $this->hasMany(Exchange::class, 'receiver_id');
    }
}
