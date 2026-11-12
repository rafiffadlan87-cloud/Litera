<p align="center">
  <img src="assets/logo.png" alt="LITERA Logo" width="160"/>
</p>

<h1 align="center">LITERA — Sistem Informasi Perpustakaan Digital Terpadu</h1>

<p align="center">
  <strong>"Era Baru Membaca."</strong><br/>
  Katalog digital, sirkulasi fisik, dan manajemen anggota dalam satu platform yang transparan, adil, dan tahan uji.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2"/>
  <img src="https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL"/>
  <img src="https://img.shields.io/badge/Vite-Badge-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS"/>
</p>

<p align="center">
  <a href="#-latar-belakang-masalah-lokal">Latar Belakang</a> •
  <a href="#-teknologi-stack">Teknologi</a> •
  <a href="#-instalasi-lokal">Instalasi</a> •
  <a href="#-akun-uji-coba">Akun Demo</a> •
  <a href="#-tim-pengembang">Tim</a>
</p>

---

## 💡 Deskripsi Singkat

**LITERA** — singkatan dari **Literasi Era** — adalah sistem informasi perpustakaan hibrida yang dikembangkan sebagai proyek Ujian Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak untuk **SMK Budi Bakti Ciwidey**. Nama ini membawa satu maksud: *era literasi dimulai* — momen ketika membaca tidak lagi dibatasi ruang, waktu, dan antrean yang tidak jelas. Sistem ini menyatukan tiga alur yang sebelumnya terpisah: penelusuran katalog digital, pengantrean peminjaman yang adil, dan verifikasi sirkulasi fisik di loket — ke dalam satu basis data terpusat dengan kendali akses berbasis peran (*Role-Based Access Control*).

> **LITERA = Literasi + Era.** Bukan sekadar nama, melainkan sebuah pernyataan: era literasi dimulai. Di sinilah membaca memasuki zamannya sendiri — terbuka, adil, dan tanpa batas.

---

## 🔍 Latar Belakang Masalah Lokal

Sebelum LITERA, pengelolaan perpustakaan sekolah bertumpu pada buku besar dan spreadsheet yang saling terlepas. Dari observasi lapangan, teridentifikasi lima gejala utama:

1. **Pencatatan sirkulasi manual** — data tersebar dan tidak pernah benar-benar sinkron antar-catatan.
2. **Stok tidak terpantau langsung** — anggota sering datang hanya untuk mendapati judul incaran sudah dipinjam orang lain.
3. **Antrean tanpa sistem** — urutan prioritas layanan tidak terjamin, giliran bergantung siapa yang paling awal datang.
4. **Rekap denda & laporan periodik manual** — rentan kesalahan input dan menyita waktu pustakawan.
5. **Buku hilang/terlambat sulit ditelusuri** — penyusutan koleksi tidak terdeteksi oleh pengelola.

LITERA menjawab kelima gejala ini dari satu akar yang sama: **data yang menyatu dan proses yang terotomasi**.

---

## 🛠️ Teknologi Stack

| Komponen | Teknologi | Catatan |
| :--- | :--- | :--- |
| Backend Framework | Laravel 12 | PHP 8.2+, arsitektur monolitik MVC |
| Database | PostgreSQL | ACID compliant, transaksi + row-locking |
| ORM | Eloquent | Prepared statement otomatis (anti-SQLi) |
| Frontend | Blade + Tailwind CSS | Server-side rendering, utility-first |
| Build Tool | Vite | HMR cepat, bundling aset |
| Autentikasi | Laravel Breeze | Session-based + RBAC (anggota/petugas/admin) |
| Font & Ikon | Plus Jakarta Sans · Material Symbols | Google Fonts CDN |
| Keamanan | CSRF · Throttle · Escape output | `@csrf`, `throttle:5,1`, escaping Blade |

---

## ⚙️ Panduan Instalasi Lokal

> **Prasyarat:** PHP ≥ 8.2, Composer, Node.js ≥ 18, PostgreSQL aktif.

### 1. Clone Repository
```bash
git clone https://github.com/[username]/litera.git
cd litera
```

### 2. Install Dependensi Backend
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan kredensial database di `.env` (lihat contoh di bawah).

### 4. Setup Database
Buat database kosong (mis. `litera_db`), lalu jalankan migrasi + seeder:
```bash
php artisan migrate --seed
```

### 5. Link Storage (untuk cover buku hasil upload)
```bash
php artisan storage:link
```

### 6. Install Dependensi Frontend
```bash
npm install
```

### 7. Jalankan Aplikasi
```bash
# Terminal 1 — server Laravel
php artisan serve

# Terminal 2 — bundler Vite
npm run dev
```

Akses di browser: `http://127.0.0.1:8000`

---

## 🔐 Contoh Konfigurasi `.env`

```dotenv
APP_NAME=LITERA
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

# DATABASE (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=litera_db
DB_USERNAME=postgres
DB_PASSWORD=secret_password

# SESSION & CACHE
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

# MAIL (opsional, untuk notifikasi)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@litera.test"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 👤 Akun Uji Coba Default

Kredensial berikut dibuat oleh seeder untuk keperluan demonstrasi dan pengujian.

| Peran | Nama | Email | Password | Akses Modul |
| :--- | :--- | :--- | :--- | :--- |
| **Admin (Pengelola)** | Administrator | `admin@litera.id` | `password` | Kelola buku/kategori/anggota/petugas, laporan, pengaturan sistem |
| **Petugas (Bu Ani)** | Petugas Perpustakaan | `petugas@litera.id` | `password` | Dashboard loket, meja sirkulasi, verifikasi pengambilan, pengembalian + denda |
| **Anggota (Siswa)** | Rafif Fadlan | `rafif@gmail.com` | `password` | Katalog, pinjam/antre FIFO, perpanjangan, riwayat, dasbor |
| **Anggota (Siswa)** | Geysa | `geysa@gmail.com` | `password` | (sama seperti di atas) |
| **Anggota (Siswa)** | Rafif Baba | `baba@gmail.com` | `password` | (sama seperti di atas) |

> ⚠️ Password default diasumsikan `password` sesuai hash seeder Laravel standar. Jika berbeda, sesuaikan sesuai isi `DatabaseSeeder.php` sebelum demo.

---

## 🧪 Fitur Unggulan

- **Antrean FIFO otomatis** — posisi dihitung dari waktu masuk; giliran #1 wajib dilayani lebih dulu, yang #2+ dan yang belum antre ditolak sistem.
- **Integritas stok anti-peminjaman ganda** — setiap peminjaman dibungkus `DB::transaction` + `lockForUpdate()`, sehingga dua permintaan serentak tidak dapat merebut salinan yang sama.
- **Perpanjangan dengan persetujuan berlapis** — anggota mengajukan, pengelola memutuskan; sistem menegakkan batas perpanjangan.
- **Kendali akses berbasis peran (RBAC)** — middleware memisahkan hak anggota, petugas, dan admin secara tegas.

---

## 👥 Anggota Pengembang & Pembagian Peran

| Nama | Peran Utama | Tanggung Jawab |
| :--- | :--- | :--- |
| **[Gesya Fikry Ramadhan]** | Fullstack Developer | Arsitektur DB, logika controller (FIFO/lock), RBAC |
| **[Rafif Fadlan Irmawan]** | UI/UX Developer | Implementasi Tailwind, layout responsif, komponen Blade |


---

## 📄 Lisensi

Dikembangkan untuk keperluan akademis (UKK RPL SMK Budi Bakti Ciwidey). Sumber terbuka di bawah lisensi **MIT** untuk kebutuhan portofolio publik.

---

<p align="center">
  <sub>Dibangun dengan ❤️ untuk era baru membaca — <strong>LITERA</strong>.</sub>
</p>