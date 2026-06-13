# ☕ SIM-C (Sistem Informasi Manajemen Cafe)

## 📖 Deskripsi Singkat Aplikasi

SIM-C (Sistem Informasi Manajemen Cafe) adalah aplikasi manajemen cafe berbasis web yang dirancang untuk membantu pengelolaan operasional cafe secara efisien dan terintegrasi. Sistem ini mencakup reservasi meja online, pengelolaan pesanan & transaksi kasir, menu digital, manajemen konten *landing page* kafe, serta laporan analitik bagi pemilik cafe untuk memantau performa bisnis.

Aplikasi ini dikelola oleh dua jenis pengguna:

* **Admin:** Mengelola seluruh operasional cafe (memantau meja, mencatat pesanan, memproses transaksi Midtrans, mengelola konten website/CMS, dan melihat laporan bisnis).
* **Pelanggan:** Dapat melihat profil kafe, melakukan reservasi meja secara online, serta memesan dan membayar pesanan langsung melalui integrasi *Payment Gateway*.

Proyek ini dikembangkan untuk keperluan akademik UAS PBW B oleh **Kelompok 10** 
* **Khairul Fikri** - NPM 2408107010032
* **Muhammad Riskan Rajabi** - NPM 24081070100110
* **Rijaludin Abdul Ghani** - NPM 2408107010008
* **Reyan Andrea** - NPM 2208107010014

## 🎯 Tujuan Pengembangan Aplikasi

Mengotomatisasi proses operasional cafe dari manual menjadi digital. Aplikasi ini bertujuan untuk mempermudah pelanggan dalam mereservasi meja, menyediakan katalog menu yang dinamis, serta memberikan kemudahan bagi pemilik cafe dalam memantau pendapatan, mengelola konten promosi website, dan melacak status pesanan secara *real-time*.

## ✨ Daftar Fitur yang Tersedia
* **CMS Landing Page:** Manajemen konten profil kafe publik secara dinamis (Hero Sliders, Profil Chef, Event Kafe, Kontak, Peta Lokasi, dan Testimoni Pelanggan).
* **Katalog Menu Dinamis:** Menampilkan daftar pesanan berdasarkan kategori (*Starters, Main Course, Desserts, Drinks*). Status ketersediaan menu dikelola sepenuhnya oleh Admin.
* **Reservasi & Manajemen Meja:** Pelanggan dapat mengajukan *request* reservasi secara online. Admin bertugas memantau dan mengatur status meja (*kosong, reservasi, digunakan*) secara terpusat melalui dashboard.
* **Manajemen Alur Pesanan (*Order Tracking*):** Pencatatan keranjang pesanan pelanggan, di mana Admin dapat memperbarui status pesanan secara bertahap (*menunggu, dimasak, disajikan, selesai, dibatalkan*).
* **Payment Gateway (Midtrans):** Pembayaran digital terintegrasi untuk setiap pesanan dengan pembaruan status transaksi secara otomatis (*unpaid, paid, failed*).
* **Laporan analitik:** Laporan pendapatan, menu terlaris, dan jam ramai untuk admin.
* **Dashboard Admin Terpadu:** Antarmuka manajemen interaktif berbasis Filament v3 yang berfungsi sebagai pusat kendali utama untuk seluruh operasional kafe.
* **Desain Fully Responsive:** Tampilan UI/UX yang estetis, modern, dan nyaman diakses melalui perangkat *mobile* maupun *desktop*.
  
## 🛠️ Teknologi, Framework, Library, dan Komponen yang Digunakan

* **Backend & Framework:** Laravel 12, PHP 8.2+
* **Admin Panel:** Filament Admin v3
* **Frontend:** Livewire, Blade Template, Tailwind CSS, Bootstrap 5
* **Database:** MySQL / MariaDB
* **Payment Gateway:** Midtrans API
* **Package Manager:** Composer 2.x, Node.js & NPM

## 🗄️ Struktur Database Utama

Proyek ini memiliki struktur relasional yang komprehensif, mencakup tabel operasional dan manajemen konten:

1. **Autentikasi:** `users` (Data Admin/Staff).
2. **Katalog Produk:** `menu_categories` dan `menu_items` (Menyimpan detail makanan, harga, gambar, dan status ketersediaan).
3. **Manajemen Meja & Reservasi:** `tables` (Status meja) dan `reservations` (Data booking pelanggan yang berelasi dengan `tables`).
4. **Transaksi & Pesanan:** `orders` dan `order_items` (Menyimpan keranjang pesanan pelanggan, total harga, relasi ke meja, serta *Snap Token* & *Payment Status* Midtrans).
5. **CMS / Profil Kafe:** `hero_sliders`, `about_contents`, `about_features`, `chefs`, `testimonials`, dan `featured_events` (Untuk kebutuhan *landing page* dinamis).

## ⚙️ Panduan Instalasi dan Menjalankan Aplikasi

### Persyaratan Sistem (*Requirements*)

* PHP 8.2+
* Composer 2.x
* MySQL / MariaDB
* Node.js & NPM


### Langkah Instalasi

1. **Clone repository:**
```bash
git clone https://github.com/username/sim-c.git
cd sim-c

```

2. **Install dependency:**
```bash
composer install
npm install && npm run build
```

3. **Konfigurasi Environment:**
   Salin file konfigurasi:
```bash
cp .env.example .env
```

Generate key aplikasi:

```bash
php artisan key:generate

```

Sesuaikan konfigurasi database dan Midtrans di file `.env`:

```env
APP_NAME="SIM-C Kelompok 10"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sim_c
DB_USERNAME=root
DB_PASSWORD=

MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false

```

4. **Siapkan Database:**
Buat database `sim_c` via phpMyAdmin atau CLI MySQL (`CREATE DATABASE sim_c;`).
5. **Jalankan Migrasi, Seeder & Storage Link:**
```bash
php artisan migrate --seed
php artisan storage:link
```

6. **Jalankan Server Lokal:**
```bash
   php artisan serve

```


```
Buka `[http://127.0.0.1:8000](http://127.0.0.1:8000)` di browser.

```
### 🔑 Akses Admin & Troubleshooting

* **URL Login Admin:** `[http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)`
* **Email Default:** `admin@example.com`

*(Jika user admin tidak bisa digunakan, buat paksa via terminal dengan perintah `php artisan tinker`, lalu paste: `\App\Models\User::create(['name' => 'Admin King Coffee', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);`)*

**Tabel Penyelesaian Masalah:**

| Masalah | Solusi |
| --- | --- |
| *Class not found* saat migrate | Jalankan `composer dump-autoload` |
| Gagal konek ke database | Periksa `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` di `.env` |
| Halaman blank / error 500 | Cek log di `storage/logs/laravel.log` |
| Gambar menu/CMS tidak muncul | Jalankan `php artisan storage:link` |
| Session/cache error | Jalankan `php artisan config:cache` dan `php artisan cache:clear` |

## 📸 Screenshot Tampilan Aplikasi

*(Silakan tambahkan gambar screenshot Halaman Utama, Menu Katalog, Checkout Midtrans, dan Dashboard Admin Filament di sini sebelum dikumpulkan)*
