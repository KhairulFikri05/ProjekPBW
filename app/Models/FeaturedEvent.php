<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedEvent extends Model
{
    /** @use HasFactory<\Database\Factories\FeaturedEventFactory> */
    use HasFactory;
    protected $fillable = [
        'event_name',
        'date',
        'time',
        'location',
        'description',
        'image_url'
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }
    
}
