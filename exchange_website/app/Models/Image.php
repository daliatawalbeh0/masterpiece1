<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'file_path',
        'alt_text',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
