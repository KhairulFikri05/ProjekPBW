# SIM-C - Cafe Management System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/Filament_PHP-EAB308?style=for-the-badge&logo=php&logoColor=white" alt="Filament PHP" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Midtrans-000000?style=for-the-badge&logo=midtrans&logoColor=white" alt="Midtrans" />
</div>

<br>

**SIM-C (Sistem Informasi Manajemen Cafe)** adalah platform digital komprehensif berbasis web yang dirancang khusus untuk memodernisasi operasional cafe atau restoran. Sistem ini menghubungkan antarmuka pemesanan mandiri oleh pelanggan (seperti reservasi meja dan order pesanan) dengan panel administrasi *backend* yang tangguh untuk memantau transaksi secara *real-time*.

Aplikasi ini mengutamakan kecepatan layanan, akurasi pesanan di dapur, dan kemudahan rekapitulasi pembayaran otomatis guna menghindari kebocoran finansial kasir.

---

## 🎯 Tujuan Pengembangan

Proyek ini dikembangkan dengan tujuan untuk mendigitalisasi proses bisnis F&B (Food and Beverage), mengubah sistem konvensional (catat kertas) menjadi serba terpusat. Dengan SIM-C, diharapkan cafe dapat:
1. Meminimalisir kesalahan pesanan (*human error*) melalui pemesanan digital langsung dari meja.
2. Mempercepat alur pembayaran dengan integrasi QRIS / Transfer Bank secara otomatis.
3. Memastikan manajemen meja (*table seating*) yang tertata rapi melalui sistem reservasi yang terotomatisasi.
4. Memudahkan pemilik usaha (Admin) dalam memanajemen stok menu, konten promosi, hingga pelacakan omset secara langsung.

---

## ✨ Fitur Utama Sistem

1. **Digital Ordering & Checkout System:** Pelanggan dapat melihat menu, memesan, dan langsung melakukan proses *checkout*.
2. **Integrasi Payment Gateway Midtrans:** Mendukung berbagai metode pembayaran instan (QRIS, GoPay, Virtual Account) dengan pembaruan status pembayaran otomatis (*paid/unpaid*).
3. **Smart Table Reservation:** Formulir reservasi (*booking*) meja yang cerdas. Status meja akan otomatis berubah menjadi "reservasi" atau "isi" saat digunakan untuk mencegah *double-booking*.
4. **Kitchen Display Status:** Manajemen aliran pesanan dengan indikator pelacakan status makanan (misalnya: status *"dimasak"* hingga *"selesai"*).
5. **Interactive Admin Dashboard (Filament):** Panel kontrol elegan dengan fungsionalitas CRUD penuh untuk manajemen Menu, Kategori, Meja, Pesanan, Reservasi, hingga Chef dan Testimoni pelanggan.
6. **Dynamic Landing Page Content:** Tampilan depan (beranda) dikelola secara dinamis lewat database, termasuk pengaturan *Hero Slider*, informasi *About*, daftar *Chef*, dan *Featured Events*.

---

## 🛠️ Teknologi dan Komponen

Proyek ini dibangun di atas tumpukan teknologi modern untuk memastikan performa, skalabilitas, dan keamanan:

- **Framework Backend:** Laravel 12 (PHP ^8.2)
- **Framework Admin Panel:** Filament PHP v3 (TALL Stack)
- **Database:** MySQL
- **Frontend & Styling:** Tailwind CSS v4, Vite, Blade Templating
- **Payment Gateway:** Midtrans (Midtrans-PHP API)
- **Arsitektur:** Model-View-Controller (MVC) Pattern

---

## 🗄️ Skema Relasi Database (ERD)

Struktur data aplikasi ini terdiri dari beberapa entitas utama yang saling berelasi kuat. Berikut adalah pemetaan *Entity-Relationship Diagram (ERD)* yang mendasari sistem manajemen cafe ini:

```mermaid
erDiagram
    TABLE ||--o{ RESERVATION : "menerima / dipesan melalui"
    TABLE ||--o{ ORDER : "tempat transaksi"
    ORDER ||--|{ ORDER_ITEM : "terdiri atas"
    MENU_ITEM ||--o{ ORDER_ITEM : "sebagai rincian pesanan"
    MENU_CATEGORY ||--o{ MENU_ITEM : "mengelompokkan"

    TABLE {
        bigint id PK
        string table_number "No. Meja"
        string status "kosong / reservasi / isi"
    }
    MENU_CATEGORY {
        bigint id PK
        string name "Kategori (Misal: Makanan/Minuman)"
    }
    MENU_ITEM {
        bigint id PK
        bigint menu_category_id FK
        string name "Nama Menu"
        decimal price "Harga Menu"
    }
    ORDER {
        bigint id PK
        bigint table_id FK
        decimal total_price "Total Harga"
        string status "dimasak / selesai"
        string payment_status "unpaid / paid / failed"
        string snap_token "Token Midtrans"
    }
    ORDER_ITEM {
        bigint id PK
        bigint order_id FK
        bigint menu_item_id FK
        int quantity "Jumlah"
        decimal price "Harga Satuan saat dipesan"
    }
    RESERVATION {
        bigint id PK
        bigint table_id FK
        string name "Nama Pemesan"
        string phone "Nomor Kontak"
        date date "Tanggal Booking"
        time time "Jam Booking"
        string status "pending / confirmed"
    }
