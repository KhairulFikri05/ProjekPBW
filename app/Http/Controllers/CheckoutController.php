<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function prosesBayar(Order $order)
    {
        // 1. Cek apakah pesanan sudah punya token, kalau belum kita mintakan ke Midtrans
        if (!$order->snap_token) {
            
            // Konfigurasi Midtrans dari file .env
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // 2. Siapkan data pesanan yang akan dikirim ke Midtrans
            $params = [
                'transaction_details' => [
                    // Kita gabungkan ID order dengan waktu agar selalu unik
                    'order_id' => 'ORDER-' . $order->id . '-' . time(), 
                    'gross_amount' => $order->total_price, // Total harga pesanan
                ],
                'customer_details' => [
                    'first_name' => 'Pelanggan Meja',
                    'last_name' => $order->table_id, // Kita numpang taruh ID meja di sini
                    'email' => 'pelanggan@example.com',
                    'phone' => '08111222333',
                ],
            ];

            // 3. Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);

            // 4. Simpan token tersebut ke database order kita
            $order->snap_token = $snapToken;
            $order->save();
        }

        // 5. Lempar data pesanan dan tokennya ke halaman tampilan depan
        return view('checkout', compact('order'));
    }

    public function webhook(\Illuminate\Http\Request $request)
    {
        // 1. Ambil kunci server dari .env untuk memverifikasi keamanan data
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        // 2. Buat rumus cocok silang (Signature Key) untuk memastikan ini beneran kiriman dari Midtrans, bukan hacker
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            
            // 3. Pecah kembali ID order-nya. Tadi kan formatnya "ORDER-ID-TIME"
            $orderIdParts = explode('-', $request->order_id);
            $realOrderId = $orderIdParts[1] ?? null;

            // Find pesanan di database
            $order = Order::find($realOrderId);

            if ($order) {
                $transactionStatus = $request->transaction_status;

                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    // JIKA LUNAS: Ubah status bayar jadi paid, dan status pesanan otomatis jadi 'dimasak'
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'dimasak' 
                    ]);
                } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    // JIKA GAGAL/KADALUWARSA: Ubah jadi failed
                    $order->update([
                        'payment_status' => 'failed'
                    ]);
                }
            }
        }

        // Beri respon balik ke Midtrans bahwa laporan sudah diterima dengan baik
        return response()->json(['status' => 'success']);
    }

    public function bayarDiKasir(\Illuminate\Http\Request $request, Order $order)
    {
        // Langsung ubah status pesanan agar dapur bisa mulai memasak,
        // TETAPI status pembayaran dibiarkan 'unpaid'
        $order->update([
            'status' => 'dimasak',
            'payment_status' => 'unpaid' 
        ]);

        // Arahkan kembali ke halaman utama (atau halaman riwayat) dengan pesan sukses
        return redirect('/')->with('success', 'Pesanan berhasil dikirim ke dapur! Silakan bayar di kasir nanti.');
    }

}