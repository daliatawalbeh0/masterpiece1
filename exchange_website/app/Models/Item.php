<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subcategory_id',
        'category_id',
        'title',
        'description',
        'price',
        'condition',
        'usage_duration',
        'image',
        'status',
        'is_exchange_specific',
        'desired_item_id',
        'desired_item_category',
        'desired_item_subcategory',
        'desired_item_description',
        'show'
    ];
    public function TheUser()
    {
        return $this->belongsTo(TheUser::class, 'user_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, 'item_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
