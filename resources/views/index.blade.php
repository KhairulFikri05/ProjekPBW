@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="container-fluid hero-container" data-aos="fade-up">
        <div class="row g-0 align-items-center">

            <!-- Text Column -->
            <div class="col-lg-6 content-col">
                <div class="content-wrapper">
                    @if (!empty($heroes) && count($heroes) > 0)
                    @foreach ($heroes as $hero)
                    @if ($loop->first) <!-- Hanya tampilkan satu konten utama -->
                    <div class="status-badge" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-clock"></i> {{ $contact->office_hours ?? '-' }}
                    </div>
                    <h2>KING COFFEE</h2>
                    <p>"Lebih dari sekadar tempat makan, ini adalah ruang untuk berbagi cerita. Nikmati perpaduan rasa autentik dengan suasana yang bikin betah berlama-lama. Dari kopi pagi hingga makan malam romantis, semua rasa ada di sini!"</p>

                    <div class="btn-group">
                        <a href="#book-a-table" class="btn btn-book">Pesan Meja</a>
                        <a href="#menu" class="btn btn-menu">
                            {{ $hero->button_text }}
                        </a>
                    </div>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <h2>Selamat datang di restoran kami</h2>
                    <p>Konten akan segera tersedia.</p>
                    @endif
                </div>
            </div>


            <!-- Image Slider Column -->
            <div class="col-lg-6 swiper-col">
                <div class="swiper hero-swiper init-swiper" data-aos="zoom-out" data-aos-delay="100">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 800,
                            "autoplay": {
                                "delay": 5000
                            },
                            "effect": "fade",
                            "slidesPerView": 1,
                            "navigation": {
                                "nextEl": ".swiper-button-next",
                                "prevEl": ".swiper-button-prev"
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">
                        @foreach ($heroes as $hero)
                        <div class="swiper-slide">
                            <div class="img-container">
                                {{-- Cek apakah isinya link internet (http) atau file lokal --}}
                                @if(str_starts_with($hero->image_url, 'http'))
                                    <img src="{{ $hero->image_url }}" alt="Hero Slide {{ $hero->title }}">
                                @else
                                    <img src="{{ asset('storage/' . $hero->image_url) }}" alt="Hero Slide {{ $hero->title }}">
                                @endif
                                <div class="caption-box" style="position: absolute; bottom: 30px; left: 30px; background: rgba(0,0,0,0.7); padding: 15px; border-radius: 8px; color: white;">
                                    <h4 style="margin: 0; color: #a0845a;">{{ $hero->title }}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

        </div>
    </div>
</section><!-- /Hero Section -->


<!-- About Section -->
<section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @if ($about)
        <div class="row align-items-center gy-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="about-content">
                    <h3>{{ $about->title }}</h3>
                    <p>{{ $about->description }}</p>
                    <div class="chef-signature mt-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="{{ asset('storage/' . $about->chef_image) }}" class="chef-avatar rounded-circle" alt="Chef Portrait">
                            </div>
                            <div class="col">
                                <p class="chef-message mb-2">"{{ $about->chef_quote }}"</p>
                                <p class="chef-name">Executive Chef</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="about-image-wrapper">
                    <img src="assets/img/restaurant/showcase-4.webp" class="img-fluid main-image shadow" alt="Restaurant Interior">
                    <img src="assets/img/restaurant/showcase-2.webp" class="img-fluid accent-image shadow" alt="Chef Preparing Food">
                    <span class="establishment-year d-flex align-items-center justify-content-center text-center">
                        Est. {{ $about->establishment_year }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        <!-- Features -->
        <div class="row mt-5 pt-4 features-section">
            @foreach ($features as $feature)
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="{{ $feature->icon_class }}"></i>
                    </div>
                    <h4>{{ $feature->title }}</h4>
                    <p>{{ $feature->description }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Stats -->
        <div class="row mt-3">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-container">
                    @foreach ($stats as $stat)
                    <div class="stat-item">
                        <span class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $stat->stat_number }}" data-purecounter-duration="1" class="purecounter"></span>+
                        </span>
                        <p class="stat-label">{{ $stat->stat_label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</section><!-- /About Section -->


<!-- Menu Section -->
<section id="menu" class="menu section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Menu</h2>
        <p>Rasakan Hidangan Terbaik Pilihan Kami</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <!-- Filter Buttons -->
            <div class="menu-filters isotope-filters mb-5">
                <ul>
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($categories as $category)
                    <li data-filter=".filter-{{ strtolower($category->slug) }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Menu Items -->
            <div class="menu-container isotope-container row gy-4">
                @foreach ($categories as $category)
                @foreach ($category->items as $item)
                <div class="col-lg-6 isotope-item filter-{{ strtolower($category->slug) }}">
                    <div class="menu-item d-flex align-items-center gap-4">
                        <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="menu-img img-fluid rounded-3">
                        <div class="menu-content {{ !$item->is_available ? 'opacity-50' : '' }}">
                            <h5>
                                {{ $item->name }}
                                
                                {{-- Tag asli menu (contoh: New, Bestseller) --}}
                                @if ($item->tags)
                                    <span class="menu-tag">{{ $item->tags }}</span>
                                @endif

                                {{-- Logika Badge Habis --}}
                                @if (!$item->is_available)
                                    <span class="badge bg-danger text-white ms-2" style="font-size: 12px; padding: 4px 8px; border-radius: 4px;">Habis</span>
                                @endif
                            </h5>
                            
                            <p>{{ $item->description }}</p>
                            
                            <div class="price">
                                {{-- Logika Harga: Dicoret kalau habis --}}
                                @if (!$item->is_available)
                                    <span style="text-decoration: line-through; color: #999;">
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                @endif
                            </div>

                            @if ($item->is_available)
                                <button type="button" class="btn btn-sm w-100 mt-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalCart-{{ Str::slug($category->name) }}-{{ $item->id }}" style="background-color: #a0845a; color: #ffffff;; border: none; padding: 8px;">
                                    + Tambah ke Keranjang
                                </button>
                            @else
                                <button class="btn btn-sm w-100 mt-2 fw-bold" style="background-color: #444; color: #999; border: none; padding: 8px; cursor: not-allowed;" disabled>
                                    Sold Out
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#" class="download-menu">
                <i class="bi bi-file-earmark-pdf"></i> Download Full Menu
            </a>
        </div>

        <!-- Chef's Specials -->
        <div class="col-12 mt-5" data-aos="fade-up">
            <div class="specials-badge">
                <span><i class="bi bi-award"></i> Chef's Specials</span>
            </div>
            <div class="specials-container">
                <div class="row g-4">
                    @forelse ($featuredItems as $item)
                    <div class="col-md-6">
                        <div class="menu-item special-item" >
                            <div class="menu-item-img">
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="img-fluid">
                                <div class="menu-item-badges">
                                    <span class="badge-special">Special</span>
                                    @if ($item->tags)
                                    @foreach (explode(',', $item->tags) as $tag)
                                    <span class="badge-{{ strtolower(trim($tag)) }}">{{ trim($tag) }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="menu-item-content">
                                <h4>{{ $item->name }}</h4>
                                <p>{{ Str::limit($item->description, 100) }}</p>
                                <div class="menu-item-price">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                </div>

                                @if ($item->is_available)
                                    <button type="button" class="btn btn-sm w-100 mt-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalCart-special-{{ $item->id }}" style="background-color: #a0845a; color: #ffffff; border: none; padding: 8px;">
                                        + Tambah ke Keranjang
                                    </button>
                                @else
                                    <button class="btn btn-sm w-100 mt-3 fw-bold" style="background-color: #444; color: #999; border: none; padding: 8px; cursor: not-allowed;" disabled>
                                        Sold Out
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada menu spesial saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
    </div>
</section><!-- /Menu Section -->

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Apa Kata Mereka Tentang Kami</h2>
        <p>Kami percaya bahwa kepuasan pelanggan adalah yang utama. Berikut adalah beberapa cerita dan kesan dari mereka yang telah menikmati layanan dan hidangan kami. Ulasan jujur mereka menjadi motivasi kami untuk terus memberikan yang terbaik.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if (!empty($testimonials) && count($testimonials) > 0)
        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "breakpoints": {
                        "320": {
                            "slidesPerView": 1,
                            "spaceBetween": 40
                        },
                        "1200": {
                            "slidesPerView": 3,
                            "spaceBetween": 1
                        }
                    }
                }
            </script>

            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <div class="stars">
                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                <i class="bi bi-star-fill"></i>
                                @endfor
                        </div>
                        <p>"{{ $testimonial->message }}"</p>
                        <div class="profile mt-auto">
                            <img src="{{ asset('storage/' . $testimonial->image_url) }}"
                                class="testimonial-img"
                                alt="{{ $testimonial->name }}">
                            <h3>{{ $testimonial->name }}</h3>
                            <h4>{{ $testimonial->role }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        @else
        <p class="text-center">Belum ada testimonial saat ini.</p>
        @endif
    </div>

</section><!-- /Testimonials Section -->

<!-- Book A Table Section -->
<section id="book-a-table" class="book-a-table section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Info & Gambar -->
        <div class="row gy-5 mb-5">
            <!-- Info -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="reservation-info">
                    <div class="text-content">
                        <h3>Pesan Meja Anda</h3>
                        <p>Silakan isi formulir di bawah ini untuk melakukan reservasi. Kami akan segera menghubungi Anda untuk konfirmasi.</p>

                        <div class="reservation-details mt-4">
                            <div class="detail-item">
                                <i class="bi bi-clock"></i>
                                <div>
                                    <h5>Jam Operasional</h5>
                                    <p>{!! $location?->hours ?? 'Jam operasional belum tersedia.' !!}</p>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <h5>Lokasi</h5>
                                    <p>{{ $location?->address ?? 'Alamat belum tersedia.' }}</p>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <h5>Hubungi Kami</h5>
                                    <p>{{ $location?->contact_phone ?? 'Nomor telepon belum tersedia.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gambar -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="reservation-image">
                    <img src="{{ asset('assets/img/restaurant/showcase-7.webp') }}" alt="Interior Restoran" class="img-fluid rounded">
                </div>
            </div>
        </div>

        <!-- Formulir Reservasi -->
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                <div class="reservation-form-wrapper">
                    <div class="form-header">

                        {{-- Pesan Sukses --}}
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Pesan Gagal --}}
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- Validasi --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <h3>Formulir Reservasi</h3>
                        <p>Isi data berikut untuk memesan meja di restoran kami.</p>
                    </div>

                    <form action="{{ route('reservations.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-lg-4 form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Anda" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
                            </div>

                            <div class="col-lg-4 form-group">
                                <select name="people" class="form-select" required>
                                    <option value="">Jumlah Tamu</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>
                                        {{ $i === 6 ? '6+ Orang' : $i . ' ' . Str::plural('Orang', $i) }}
                                        </option>
                                        @endfor
                                </select>
                            </div>

                            <div class="col-lg-4 form-group">
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="time" name="time" class="form-control" value="{{ old('time') }}" required>
                            </div>

                            <div class="form-group mt-4">
                                <textarea class="form-control" name="message" rows="3" placeholder="Permintaan Khusus (Opsional)">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn-book-table">Pesan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Location Section -->
@if ($location)
<section id="location" class="location section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Location</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="map-container">
                    {!! $location->map_embed !!}
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="info-container">
                    <div class="section-header">
                        <h2>Find Us</h2>
                        <p>Visit Us Today</p>
                    </div>

                    <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Our Location</h3>
                            <p>{{ $location->address }}</p>
                        </div>
                    </div>

                    <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="info-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="info-content">
                            <h3>Reservations</h3>
                            <p>{{ $location->contact_phone }}</p>
                            <p class="small-text">We recommend making reservations at least 48 hours in advance</p>
                        </div>
                    </div>

                    <div class="info-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="info-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="info-content">
                            <h3>Hours</h3>
                            <div class="hours-grid">
                                @foreach (explode("\n", $location->hours) as $hour)
                                @if (Str::contains($hour, ':'))
                                @php
                                [$day, $time] = array_pad(explode(':', $hour, 2), 2, '');
                                @endphp
                                <div class="day">{{ trim($day) }}</div>
                                <div class="time">{{ trim($time) }}</div>
                                @else
                                <div class="day">{{ $hour }}</div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="cta-wrapper" data-aos="fade-up" data-aos-delay="600">
                        <a href="#book-a-table" class="btn-book">Make a Reservation</a>
                        <a href="#contact" class="btn-contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section><!-- /Location Section -->
@else
<section class="location section text-center py-5">
    <div class="container">
        <h3>Informasi lokasi belum tersedia.</h3>
        <p>Silakan tambahkan detail lokasi melalui panel admin..</p>
    </div>
</section>
@endif



<!-- Events Section -->
<section id="events" class="events section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Intro Text -->
        <div class="intro-text text-center mb-5" data-aos="fade-up" data-aos-delay="150">
            <h2>Ciptakan Momen Tak Terlupakan</h2>
            <p>Rasakan pengalaman istimewa bersama orang-orang tercinta. Setiap hidangan dan suasana kami hadir untuk menciptakan kenangan yang berkesan.</p>
        </div>

        <!-- Event Types -->
        <div class="event-types">
            <div class="row">
                @foreach ($eventTypes as $type)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 50) }}">
                    <div class="event-type-card">
                        <div class="icon-wrapper">
                            <i class="{{ $type->icon_class }}"></i>
                        </div>
                        <h3>{{ $type->name }}</h3>
                        <p>{{ Str::limit($type->description, 80) }}</p>
                        <span class="capacity">Up to {{ $type->capacity }} guests</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Gallery Showcase -->


        <!-- CTA Book Venue -->
        <div class="event-cta" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3>Siap merencanakan acara spesial Anda?</h3>
                    <p>Kami siap membantu mewujudkan momen istimewa Anda. Hubungi kami hari ini untuk mendiskusikan kebutuhan dan detail acara Anda.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#contact" class="btn-reserve">Pesan Tempat</a>
                </div>
            </div>
        </div>


        <!-- Upcoming Featured Events -->
        <div class="featured-events" data-aos="fade-up" data-aos-delay="200">
            <h3>Event Unggulan yang Akan Datang</h3>

            <div class="row g-4">
                @forelse ($featuredEvents as $event)
                <div class="col-lg-6 col-md-6">
                    <div class="featured-event-card" data-aos="fade-up" data-aos-delay="{{ 250 + ($loop->index * 50) }}">
                        <div class="event-date">
                            @php
                            $date = \Carbon\Carbon::parse($event->date);
                            @endphp
                            <span class="month">{{ $date->format('M') }}</span>
                            <span class="day">{{ $date->format('d') }}</span>
                        </div>
                        <div class="event-content">
                            <div class="event-image">
                                <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->event_name }}" class="img-fluid">
                            </div>
                            <div class="event-info">
                                <h4>{{ $event->event_name }}</h4>
                                <ul class="event-meta">
                                    <li><i class="bi bi-clock"></i> {{ $event->time }}</li>
                                    <li><i class="bi bi-geo-alt"></i> {{ $event->location }}</li>
                                </ul>
                                <p>{!! nl2br(e($event->description)) !!}</p>
                                <a href="#" class="btn-details">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p>Tidak ada acara mendatang untuk saat ini. Nantikan update terbaru dari kami!</p>
                </div>
                @endforelse
            </div>
        </div>


    </div>

</section><!-- /Events Section -->

</section>



<!-- Contact Section -->
<section id="contact" class="contact section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Hubungi Kami</h2>
        <p>Silakan hubungi kami melalui informasi berikut atau datang langsung ke lokasi.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Contact Info Boxes -->
        <div class="row gy-4 mb-5">

            {{-- Alamat --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-info-box">
                    <div class="icon-box">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>Alamat</h4>
                        <p>{{ $location->address ?? 'Alamat belum tersedia.' }}</p>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-info-box">
                    <div class="icon-box">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h4>Email</h4>
                        <p>{{ $contact->email_1 ?? 'Belum tersedia.' }}</p>
                        @if (!empty($contact->email_2))
                        <p>{{ $contact->email_2 }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Telepon --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-info-box">
                    <div class="icon-box">
                        <i class="bi bi-phone"></i>
                    </div>
                    <div class="info-content">
                        <h4>No Telp</h4>
                        <p>{{ $contact->phone ?? 'Belum tersedia.' }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section><!-- /Contact Section -->

@foreach ($categories as $category)
    @foreach ($category->items as $item)
        @if ($item->is_available)
            <div class="modal fade" id="modalCart-{{ Str::slug($category->name) }}-{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ Str::slug($category->name) }}-{{ $item->id }}" aria-hidden="true" style="z-index: 99999999;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-light" style="border: 1px solid #444;">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title" id="modalLabel-{{ Str::slug($category->name) }}-{{ $item->id }}" style="color: #a0845a;">
                                Pesan {{ $item->name }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="img-fluid rounded mb-3 shadow" style="height: 150px; object-fit: cover; width: 100%;">
                                
                                <h4 class="mb-3">Rp{{ number_format($item->price, 0, ',', '.') }}</h4>
                                
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <label for="quantity" class="me-3 fw-bold">Jumlah:</label>
                                    <input type="number" name="quantity" class="form-control text-center bg-dark text-light border-secondary" value="1" min="1" max="50" style="width: 80px;" required>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary justify-content-center">
                                <button type="submit" class="btn fw-bold px-4" style="background-color: #a0845a; color: #ffffff;">
                                    Masukkan Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endforeach

@foreach ($featuredItems as $item)
    @if ($item->is_available)
        <div class="modal fade" id="modalCart-special-{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel-special-{{ $item->id }}" aria-hidden="true" style="z-index: 99999999;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark text-light" style="border: 1px solid #444;">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title" id="modalLabel-special-{{ $item->id }}" style="color: #a0845a;">
                            Pesan {{ $item->name }} (Special)
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="img-fluid rounded mb-3 shadow" style="height: 150px; object-fit: cover; width: 100%;">
                            
                            <h4 class="mb-3">Rp{{ number_format($item->price, 0, ',', '.') }}</h4>
                            
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <label for="quantity" class="me-3 fw-bold">Jumlah:</label>
                                <input type="number" name="quantity" class="form-control text-center bg-dark text-light border-secondary" value="1" min="1" max="50" style="width: 80px;" required>
                            </div>
                        </div>
                        <div class="modal-footer border-secondary justify-content-center">
                            <button type="submit" class="btn fw-bold px-4" style="background-color: #a0845a; color: #ffffff;">
                                Masukkan Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach


@endsection
