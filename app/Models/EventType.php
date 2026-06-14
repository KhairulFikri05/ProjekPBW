<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'capacity',
        'description',
        'icon_class'
    ];
}
