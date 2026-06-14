<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pesanan - SIM-C KING COFFEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="mb-4">Detail Pembayaran</h3>
                    
                    <p class="text-muted mb-1">Nomor Order: <strong>#{{ $order->id }}</strong></p>
                    <p class="text-muted mb-4">Meja: <strong>{{ $order->table_number ?? $order->table_id }}</strong></p>
                    
                    <h2 class="text-primary mb-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>

                    <button id="pay-button" class="btn btn-success btn-lg w-100 mb-3">
                        💳 Bayar Sekarang (QRIS/Transfer)
                    </button>

                    <form action="{{ route('checkout.kasir', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-lg w-100">
                            🧑‍🍳 Pesan & Bayar Nanti di Kasir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Ketika tombol bayar diklik
    document.getElementById('pay-button').onclick = function(){
        // Panggil Snap Token yang sudah kita siapkan di Controller
        snap.pay('{{ $order->snap_token }}', {
            // Jika pembayaran berhasil (Lunas)
            onSuccess: function(result){
                alert("Pembayaran berhasil! Pesanan Anda akan segera disiapkan.");
                
                // 🌟 JALAN NINJA: Oper ID pesanan ke rute sukses agar database ter-update
                window.location.href = "/checkout/success?order_id={{ $order->id }}";
            },
            // Jika pembayaran tertunda (Misal: baru milih Virtual Account tapi belum ditransfer)
            onPending: function(result){
                alert("Menunggu pembayaran Anda. Silakan selesaikan transfer.");
                window.location.href = "/";
            },
            // Jika pembayaran ditolak/gagal
            onError: function(result){
                alert("Mohon maaf, pembayaran gagal!");
            },
            // Jika user menutup pop-up tanpa memilih metode bayar
            onClose: function(){
                alert('Anda menutup kotak pembayaran sebelum menyelesaikan transaksi.');
            }
        });
    };
</script>

</body>
</html>