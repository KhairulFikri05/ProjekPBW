<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'total_price',
        'status',
        'payment_status',
    ];

    // Relasi ke Meja (Satu pesanan punya satu meja)
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    // Relasi ke Rincian Menu (Satu pesanan bisa punya banyak menu)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function updateTotalPrice()
    {
        $total = 0;
        
        // Tambahan ->get() di sini adalah kunci saktinya!
        // Ini memaksa Laravel mengecek ulang ke database yang paling terbaru.
        foreach ($this->orderItems()->get() as $item) { 
            $total += ($item->price * $item->quantity);
        }
        
        $this->updateQuietly(['total_price' => $total]);
    }
}