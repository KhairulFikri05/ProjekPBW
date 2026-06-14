<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request, $menuId)
    {
        $menu = \App\Models\MenuItem::findOrFail($menuId);
        $cart = session()->get('cart', []);
        
        // Ambil jumlah pesanan dari form pop-up. Kalau kosong, default-nya 1.
        $quantity = $request->input('quantity', 1);

        // Kalau menu sudah ada di keranjang, tambahkan jumlahnya
        if(isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += $quantity;
        } else {
            // Kalau belum ada, buat data baru di keranjang
            $cart[$menuId] = [
                "name" => $menu->name,
                "quantity" => $quantity, // Gunakan variabel quantity
                "price" => $menu->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $menu->name . ' masuk keranjang!');
    }

    public function index()
    {
        return view('cart'); // Nanti kita buat file view ini
    }

    public function checkout(Request $request)
    {
        // Validasi agar input table_id tidak kosong
        $request->validate([
            'table_id' => 'required|integer',
        ]);
        
        $cart = session()->get('cart');
        
        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // 1. Hitung total harga
        $total = 0;
        foreach($cart as $item) {
            $total += ($item['price'] * $item['quantity']);
        }

        // 2. Simpan ke database 'orders'
        $order = Order::create([
            'total_price' => $total,
            'status' => 'menunggu', // Status awal
            'payment_status' => 'unpaid',
            'table_id' => $request->table_id ?? 1, // Pastikan ada input nomor meja
        ]);

        foreach (session('cart') as $menuId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuId,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // 3. Kosongkan keranjang setelah order dibuat
        session()->forget('cart');

        // 4. Arahkan ke halaman checkout yang sudah kita buat tadi
        return redirect('/checkout/' . $order->id);
    }
}