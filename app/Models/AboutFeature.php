<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutFeature extends Model
{
    /** @use HasFactory<\Database\Factories\AboutFeatureFactory> */
    use HasFactory;
    protected $fillable = [
        'icon_class',
        'title',
        'description',
        'order_number'
    ];
}
