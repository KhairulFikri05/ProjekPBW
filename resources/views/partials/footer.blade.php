<footer id="footer" class="footer">

    <div class="container footer-top">
        <div class="row gy-4">
            {{-- Kolom: About --}}
            <div class="col-lg-5 col-md-12 footer-about">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <span class="sitename">Sistem Informasi Manajemen Coffee</span>
                </a>

                @php use Illuminate\Support\Str; @endphp
                <p>
                    {{ isset($about) && $about->description ? Str::words(strip_tags($about->description), 30, ' ....') : 'Deskripsi belum tersedia.' }}
                </p>

                <div class="social-links d-flex mt-4">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            {{-- Kolom: Useful Links --}}
            <div class="col-lg-2 col-6 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Booking</a></li>
                    <li><a href="#">Events</a></li>
                </ul>
            </div>

            {{-- Kolom: Event Types --}}
            <div class="col-lg-2 col-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                    @if (!empty($eventTypes) && count($eventTypes) > 0)
                    @foreach ($eventTypes as $type)
                    <li><a href="#">{{ $type->name }}</a></li>
                    @endforeach
                    @else
                    <li><span>Belum ada layanan</span></li>
                    @endif
                </ul>
            </div>

            {{-- Kolom: Kontak --}}
            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Contact Us</h4>
                <p>{{ $location->address ?? 'Alamat belum diatur' }}</p>
                <p class="mt-4"><strong>Phone:</strong> <span>{{ $contact->phone ?? '-' }}</span></p>
                <p><strong>Email:</strong> <span>{{ $contact->email_1 ?? '-' }}</span></p>
            </div>
        </div>
    </div>


    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            <p>
                Designed by <a href="https://bootstrapmade.com/" target="_blank" rel="noopener">SIM-C</a> | Developed by SIM-C Project</a>
            </p>

        </div>
    </div>

</footer>
