<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <i class="bi bi-fork-knife"></i>
                <h1 class="sitename">SIM-C</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#book-a-table">Pesan Meja</a></li>
                    <li><a href="#events">Acara</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- Tombol CTA dari Hero --}}
            @if (!empty($heroes) && isset($heroes[0]->button_text))
            <a class="btn-getstarted d-none d-s
            m-block" href="#menu">
                {{ $heroes[0]->button_text }}
            </a>
            @else
            <a class="btn-getstarted d-none d-sm-block" href="#book-a-table">
                Pesan Sekarang
            </a>
            @endif

        </div>
    </header>
