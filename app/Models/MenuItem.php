<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image_url',
        'tags',
        'is_available',
        'is_featured'
    ];
    
    public function category()
    {
        return $this->belongsTo(MenuCategory::class);
    }
}
