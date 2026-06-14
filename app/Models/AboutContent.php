<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'chef_quote',
        'chef_image',
        'establishment_year'
    ];
}
