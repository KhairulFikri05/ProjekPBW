<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    /** @use HasFactory<\Database\Factories\HeroSliderFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'button_text',
        'button_link',
        'order_number',
        'is_active'
    ];
}
