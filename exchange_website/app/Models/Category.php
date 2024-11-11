<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount_rate',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
