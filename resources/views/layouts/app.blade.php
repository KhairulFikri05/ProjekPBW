<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIM-C</title>
    <meta name="description" content="Nikmati sajian istimewa dari Restoran Kami — tempat terbaik untuk pengalaman kuliner tak terlupakan.">
    <meta name="keywords" content="restoran, makanan enak, kuliner, tempat makan, reservasi restoran, restoran romantis, restoran keluarga">
    <meta name="author" content="SIM-C">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>



<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

<button class="btn position-fixed shadow-lg d-flex align-items-center justify-content-center" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#cartOffcanvas" 
        aria-controls="cartOffcanvas"
        style="bottom: 90px; right: 30px; width: 65px; height: 65px; border-radius: 50%; z-index: 999999; background-color: #a0845a; border: 2px solid #222;">
    <span style="font-size: 26px;">🛒</span>
    
    @php $cartCount = count(session('cart', [])); @endphp
    @if($cartCount > 0)
        <span class="badge bg-danger rounded-pill position-absolute shadow" style="top: 0; right: 0; font-size: 13px;">
            {{ $cartCount }}
        </span>
    @endif
</button>

<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel" style="z-index: 9999999; border-left: 1px solid #333;">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 id="cartOffcanvasLabel" style="color: #a0845a; margin-bottom: 0;">🛒 Keranjang Pesanan</h5>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column">
        @php
            $cart = session('cart', []);
            $total = 0;
        @endphp

        @if(count($cart) > 0)
            <div class="cart-items flex-grow-1 overflow-auto pe-2">
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-secondary">
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $details['name'] }}</h6>
                            <small class="text-secondary">{{ $details['quantity'] }}x @ Rp{{ number_format($details['price'], 0, ',', '.') }}</small>
                        </div>
                        <div class="fw-bold" style="color: #a0845a;">
                            Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-checkout-section mt-3 pt-3 border-top border-secondary">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="fw-bold m-0">Total Tagihan</h5>
                    <h5 class="fw-bold m-0" style="color: #a0845a;">Rp{{ number_format($total, 0, ',', '.') }}</h5>
                </div>

                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-light">Pilih Nomor Meja</label>
                        <select name="table_id" class="form-select bg-dark text-light border-secondary" required>
                            <option value="">-- Silakan Pilih --</option>
                            <option value="1">Meja 1</option>
                            <option value="2">Meja 2</option>
                            <option value="3">Meja 3</option>
                        </select>
                    </div>
                    <button type="submit" class="btn w-100 fw-bold py-2" style="background-color: #a0845a; color: #ffffff;">
                        Lanjut Pembayaran 💳
                    </button>
                </form>
            </div>
        @else
            <div class="text-center mt-5">
                <div style="font-size: 50px; opacity: 0.5;">☕</div>
                <h5 class="mt-3 text-secondary">Keranjang masih kosong.</h5>
                <p class="text-secondary mb-4">Yuk, pilih menu favoritmu!</p>
                <button type="button" class="btn btn-outline-warning w-100" data-bs-dismiss="offcanvas">Lihat Menu</button>
            </div>
        @endif
    </div>
</div>

</body>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>


</html>
