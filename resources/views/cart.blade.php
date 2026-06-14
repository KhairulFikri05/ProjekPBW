<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Anda - SIM-C KING COFFEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Mengubah warna tombol */
        .btn-primary, .btn-warning {
            background-color: #a0845a !important;
            border-color: #a0845a !important;
            color: #ffffff !important;
        }
        /* Efek saat tombol disorot mouse (sedikit lebih gelap) */
        .btn-primary:hover, .btn-warning:hover {
            background-color: #8b724c !important; 
            border-color: #8b724c !important;
            color: #ffffff !important;
        }
        /* Mengubah background kotak form (card) */
        .card.bg-secondary {
            background-color: #a0845a !important;
            border-color: #a0845a !important;
        }
        /* Memberi aksen warna pada kepala tabel */
        .table-dark thead th {
            background-color: #a0845a !important;
            color: #ffffff !important;
            border-bottom-color: #8b724c !important;
        }
    </style>
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <h2 class="mb-4">Keranjang Pesanan Anda</h2>
    
    @if(session('cart'))
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $details)
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card bg-secondary text-white p-4">
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Pilih Nomor Meja:</label>
                <select name="table_id" class="form-control">
                    <option value="1">Meja 1</option>
                    <option value="2">Meja 2</option>
                    <option value="3">Meja 3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">Konfirmasi Pesanan & Bayar</button>
        </form>
    </div>
    @else
        <p>Keranjang kosong. Yuk pesan dulu!</p>
        <a href="/" class="btn btn-warning">Kembali ke Menu</a>
    @endif
</div>

</body>
</html>