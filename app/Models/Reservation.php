<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use Illuminate\Http\Request;
class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'people',
        'date',
        'time',
        'message',
        'table_id',
        'status'
    ];


    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required',
            'message' => 'nullable|string|max:500',
        ]);

        // Simpan data ke database
        Reservation::create(array_merge($validated, [
            'status' => 'pending' // default status
        ]));

        return redirect()->back()->with('success', 'Your reservation request has been received!');
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    protected static function booted()
    {
        // 1. Saat dibuat
        static::created(function ($reservation) {
            if ($reservation->table_id) {
                // Panggil Table::find langsung secara eksplisit
                \App\Models\Table::find($reservation->table_id)?->update(['status' => 'reservasi']);
            }
        });

        // 2. Saat di-update
        static::updated(function ($reservation) {
            if ($reservation->isDirty('table_id')) {
                $oldTableId = $reservation->getOriginal('table_id');
                if ($oldTableId) {
                    \App\Models\Table::find($oldTableId)?->update(['status' => 'kosong']);
                }
            }
            
            if ($reservation->table_id) {
                \App\Models\Table::find($reservation->table_id)?->update(['status' => 'reservasi']);
            }
        });

        // 3. Saat dihapus
        static::deleted(function ($reservation) {
            if ($reservation->table_id) {
                \App\Models\Table::find($reservation->table_id)?->update(['status' => 'kosong']);
            }
        });
    }

}
