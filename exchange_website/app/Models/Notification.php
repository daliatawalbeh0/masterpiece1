<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلفاً عن الاسم الافتراضي
    protected $table = 'notifications';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    // دالة لتحويل البيانات المخزنة في الحقل 'data' إلى JSON
    protected $casts = [
        'data' => 'array',
    ];

    // إذا كان هناك علاقة مع المستخدم (optional)
    public function user()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
