<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutStat extends Model
{
    /** @use HasFactory<\Database\Factories\AboutStatFactory> */
    use HasFactory;

    protected $fillable = [
        'stat_number',
        'stat_label',
        'order_number'
    ];
    
}
