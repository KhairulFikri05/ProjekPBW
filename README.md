# 🍽️ Kape Cihanjuang

Aplikasi manajemen restoran berbasis web, dibangun dengan **Laravel 12** dan **Filament Admin v3**.
Proyek ini dikembangkan oleh tim **mulaidigital.com** untuk membantu restoran mengelola menu, reservasi, galeri, testimoni pelanggan, event, dan konten lainnya melalui panel admin yang modern, elegan, dan responsif.

---

## 🚀 Fitur Utama
- Manajemen Menu & Kategori
- Reservasi Online
- Galeri & Event Terjadwal
- Kontak & Lokasi
- Testimoni Pelanggan
- Dashboard Admin berbasis Filament
- Desain Fully Responsive (mobile & desktop)

---

## 👨‍💼 Developer
- Nama: **[DENS]**
- Email: deniekapratama07@gmail.com

---

## 🛠️ Teknologi yang Digunakan
- Laravel 12
- Filament Admin (v3)
- Blade Template & Livewire
- Tailwind CSS, Bootstrap 5, daisyUI, Animate.css
- MySQL
- Laravel Seeder & Factory

---

## 🧑‍🍳 Cara Instalasi (Localhost)
Ikuti langkah berikut untuk menjalankan aplikasi:

1. Ekstrak file `kapecihanjuang.zip`
2. Install dependency dengan Composer (versi **2.8.3+**):
   jalankan perintah composer install atau composer update
   > Pastikan PHP **8.2+** sudah terpasang (rekomendasi PHP 8.4).
3. Salin file `.env` dari `.env.example`
4. Generate key aplikasi:
   php artisan key:generate
5. Sesuaikan konfigurasi `.env`, contoh:
   APP_NAME=KapecihanJuang
   APP_ENV=local
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kapecihanjuang
   DB_USERNAME=root
   DB_PASSWORD=
6. Buat database `kapecihanjuang` (via phpMyAdmin atau CLI)
7. Import file kapecihanjuang.sql ke database kamu
8. Jalankan server:
   php artisan serve

   Buka http://127.0.0.1:8000

---

## 🔑 Akses Admin
- URL: http://127.0.0.1:8000/admin
- Email: admin@example.com
- Password: admin@example.com

Jika user admin belum ada, buat manual via Tinker:
\App\Models\User::create([
  'name' => 'Admin',
  'email' => 'admin@example.com',
  'password' => bcrypt('password'),
]);

---

## 🪠 Troubleshooting

| Masalah                                      | Solusi                                                                           |
| -------------------------------------------- | -------------------------------------------------------------------------------- |
| `Class not found` saat `php artisan migrate` | Jalankan `composer dump-autoload`                                                |
| Gagal konek ke database                      | Periksa `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env`                |
| Akses `/admin/login` tapi halaman kosong     | Jalankan `php artisan migrate --seed` dan pastikan user admin ada                |
| Halaman blank                                | Periksa log di `storage/logs/laravel.log`                                        |
| Error ekstensi `pdo_mysql`                   | Aktifkan ekstensi di `php.ini`                                                   |

---

## 📦 Perintah Composer & Artisan yang Berguna
composer install           # Install dependency
composer update            # Update package
php artisan storage:link   # Buat symbolic link untuk upload
php artisan serve          # Jalankan server
php artisan tinker         # CLI query langsung

---

## 📄 Lisensi
Proyek ini dikembangkan dan dimiliki oleh **mulaidigital.com**.
Silakan gunakan kode ini dengan bijak. Untuk kerjasama hubungi:
📧 deniekapratama07@gmail.com

---

## 📬 Kontak
- 🌐 Website: https://mulaidigital.com
- ✉️ Email: deniekapratama07@gmail.com

---

> Terima kasih
