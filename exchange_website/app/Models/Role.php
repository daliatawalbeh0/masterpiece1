<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'roles';

    // الأعمدة التي يمكن تعبئتها
    protected $fillable = ['name']; // تأكد من أن هذا العمود موجود في الجدول

    /**
     * علاقة الدور مع المستخدمين.
     * كل دور يمكن أن يحتوي على العديد من المستخدمين.
     */
    public function users()
    {
        return $this->hasMany(TheUser::class, 'role_id');
    }
}
