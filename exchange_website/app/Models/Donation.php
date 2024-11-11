<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    // تحديد الحقول القابلة للتعبئة (fillable)
    protected $fillable = [
        'donor_id',
        'image',
        'description',
        'item_title',
        'status'
    ];





    // العلاقة مع المستخدم (الذي يقوم بالتبرع)
    public function donor()
    {
        return $this->belongsTo(TheUser::class, 'donor_id');
    }
}
