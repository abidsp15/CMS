# CMS Store - CodeIgniter 4 Project 🚀

Sistem Content Management System (CMS) simpel buat simulasi proses pembelian produk. Project ini dibangun pakai framework CodeIgniter 4 dan mengimplementasikan operasi CRUD dasar, ditambah berbagai fitur keren kayak upload gambar, DataTables, SweetAlert, Dashboard statistik, sampai Export ke PDF!

## 🌟 Fitur Utama
- **Dashboard Statistik**: Buat ngecek ringkasan jumlah produk, pesanan, dan total pendapatan secara cepat.
- **Manajemen Produk (CRUD)**: Bisa Create, Read, Update, Delete data produk sekalian upload gambarnya.
- **Simulasi Pembelian**: Ada tombol "Buy" buat langsung beli produk. Stok bakal otomatis berkurang dan pesanan langsung tercatat.
- **Invoice PDF**: Selesai beli, invoice otomatis di-generate dan langsung bisa di-download dalam format PDF berkat Dompdf.
- **DataTables**: List produk jadi lebih rapi dengan fitur pencarian, pagination, dan sorting yang interaktif.
- **SweetAlert**: Notifikasi cakep buat ngasih tau kalau aksi berhasil/gagal, plus ada modal konfirmasi pas mau hapus data.
- **Responsive Layout**: Tampilan aman dan rapi dibuka dari HP karena pakai Bootstrap 5.
- **API Endpoints**: Tersedia endpoint RESTful buat ngambil data produk dan simulasi pesanan.

## 🛠 Prasyarat
Sebelum mulai, pastiin di laptop/PC udah terinstall:
- PHP >= 8.1
- Composer
- Ekstensi PHP: intl, mbstring, dom, json, libxml, mysqli (atau pdo_mysql)
- MySQL / MariaDB buat databasenya

---

## 📖 Cara Install & Setup

### 1. Ekstrak / Clone Project
Masuk ke terminal/command prompt, lalu arahkan ke folder root project ini.

### 2. Install Dependencies
Jalankan perintah ini buat nginstall semua library yang dibutuhin (termasuk CodeIgniter dan Dompdf):
```bash
composer install
```

### 3. Setup Environment
1. Copy file `env` jadi `.env`:
   ```bash
   cp env .env
   ```
2. Buka file `.env` terus sesuaikan konfigurasi database-nya:
   ```env
   database.default.hostname = localhost
   database.default.database = cms_store
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```
   *(Ubah username sama password sesuai settingan MySQL lokal masing-masing ya)*

### 4. Buat Database
Bikin database kosong di MySQL (bisa lewat phpMyAdmin atau terminal) dengan nama `cms_store` (atau nama lain, pokoknya samain sama yang ditulis di file `.env`).

### 5. Jalankan Migrasi dan Seeder
Proyek ini sudah dilengkapi skema database otomatis beserta data *dummy*. Jalankan perintah berikut di terminal:
```bash
php spark migrate:refresh
php spark db:seed DummySeeder
```
*(Perintah ini akan men-generate tabel `products` dan `orders` ke dalam database, dan mengisi tabel produk dengan data dummy awal)*

### 6. Nyalain Server
Terakhir, jalankan development server bawaannya CodeIgniter:
```bash
php spark serve
```
Sekarang aplikasinya udah jalan dan bisa dibuka di browser lewat link: **http://localhost:8080** 🎉

---

## 🎮 Cara Pakai Aplikasinya

- **Beranda (Dashboard)**: Tampilan awal pas buka web. Isinya ringkasan statistik (total produk, total pesanan, total pemasukan).
- **Menu Products**: 
  - **Daftar**: Lihat semua produk yang ada di DataTables (bisa di-search atau di-urutin sesuka hati).
  - **Tambah (Create)**: Klik "Tambah Produk" buat buka form isian data plus fasilitas upload fotonya.
  - **Aksi (Edit/Delete)**: Bisa ganti detail barang atau hapus datanya. Tenang aja, pas mau hapus bakal muncul dialog konfirmasi biar gak salah pencet (SweetAlert).
  - **Beli (Buy)**: Klik icon *cart* warna hijau buat nyoba checkout barangnya. Setelah diklik, stok produk bakal otomatis kepotong, pesanan masuk ke database, dan invoice-nya langsung ter-download dalam bentuk PDF.

## 🔌 Nyoba API Endpoint
Project ini juga nyediain API berbasis JSON yang asyik buat dicoba langsung pakai Postman atau Insomnia:
- `GET /api/products` : Buat narik list semua produk.
- `GET /api/products/{id}` : Buat narik detail satu produk spesifik berdasarkan ID-nya.
- `POST /api/orders` : Endpoint buat bikin pesanan baru.
  *(Parameter yang harus dikirim di body/form-data: `product_id` sama `quantity`)*
