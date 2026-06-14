<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'price',
    ];

    // Relasi balik ke Pesanan utama
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke detail Menu (untuk memunculkan nama menu & gambar)
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    protected static function booted()
    {
        // Trigger saat menu ditambahkan / diubah
        static::saved(function ($orderItem) {
            $order = \App\Models\Order::find($orderItem->order_id);
            $order?->updateTotalPrice();
        });

        // Trigger saat menu dihapus
        static::deleted(function ($orderItem) {
            $order = \App\Models\Order::find($orderItem->order_id);
            $order?->updateTotalPrice();
        });
    }
}