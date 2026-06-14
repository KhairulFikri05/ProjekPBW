<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    /** @use HasFactory<\Database\Factories\MenuCategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }
}
