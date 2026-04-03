<div align="center">

# ⚓ e-LABSIM
### Electronic Laboratory & Simulator Management System

**Berbasis Laravel 12 | Politeknik Maritim AMI Makassar**

[![Laravel](https://img.shields.io/badge/Laravel-12.33-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Node](https://img.shields.io/badge/Node.js-20.19%2B%20%7C%2022.12%2B-339933?style=for-the-badge&logo=node.js&logoColor=white)](https://nodejs.org)
[![Livewire](https://img.shields.io/badge/Livewire-3.6.4-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.1.11-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-22c55e?style=for-the-badge)](LICENSE)

> Sistem manajemen penjadwalan laboratorium dan simulator berbasis web yang dilengkapi fitur **Conflict Detection** dan **Reporting** sebagai solusi transformasi digital di Politeknik Maritim AMI Makassar.

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Setup](#-instalasi--setup)
- [Menjalankan Aplikasi](#%EF%B8%8F-menjalankan-aplikasi)
- [Konfigurasi Environment](#%EF%B8%8F-konfigurasi-environment)
- [Struktur Role & Akses](#-struktur-role--akses)
- [Struktur Direktori](#-struktur-direktori)
- [Perintah Berguna](#-perintah-berguna)
- [Troubleshooting](#-troubleshooting)
- [Lisensi](#-lisensi)

---

## 🎯 Tentang Proyek

**e-LABSIM** adalah sistem manajemen laboratorium dan simulator elektronik yang dikembangkan sebagai solusi digitalisasi proses penjadwalan di **Politeknik Maritim AMI Makassar**. Sistem ini dirancang untuk menggantikan proses penjadwalan manual yang rawan konflik dan sulit dilacak.

Proyek ini merupakan bagian dari penelitian Skripsi S1 Sistem Informasi dengan judul:

> *"Pengembangan Electronic Laboratory & Simulator Management System (e-LABSIM) Berbasis Laravel: Solusi Transformasi Digital Penjadwalan Melalui Implementasi Fitur Reporting dan Conflict-Detection di Politeknik Maritim AMI Makassar"*

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 📅 **Manajemen Jadwal** | Buat, edit, dan kelola jadwal penggunaan laboratorium & simulator |
| ⚠️ **Conflict Detection** | Deteksi otomatis bentrokan jadwal (ruang, waktu, instruktur) secara real-time |
| 📊 **Reporting** | Laporan penggunaan lab dalam format tabel & grafik, ekspor ke PDF dan Excel |
| 🔐 **Autentikasi & Role** | Sistem login multi-role (Admin, Dosen/Instruktur, Operator, Mahasiswa) |
| 🔔 **Notifikasi** | Notifikasi in-app untuk pengingat jadwal & status persetujuan |

---

## 🛠 Tech Stack

### Backend — Versi Terinstall

| Package | Versi | Keterangan |
|---------|-------|------------|
| **laravel/framework** | 12.33.0 | PHP framework utama |
| **PHP** | ^8.2 | Server-side language |
| **livewire/livewire** | 3.6.4 | Full-stack reactive components |
| **livewire/flux** | 2.5.1 | UI component library resmi Livewire |
| **livewire/volt** | 1.7.2 | Single-file Livewire components |
| **laravel/fortify** | 1.31.1 | Backend authentication (login, register, 2FA) |
| **laravel/tinker** | 2.10.1 | REPL interaktif untuk debugging |
| **barryvdh/laravel-dompdf** | 3.1.1 | Ekspor laporan ke PDF |
| **maatwebsite/excel** | 3.1.67 | Ekspor/impor data ke file Excel (.xlsx) |
| **nesbot/carbon** | 3.10.3 | Manipulasi tanggal & waktu |
| **guzzlehttp/guzzle** | 7.10.0 | HTTP client untuk integrasi eksternal |

### Backend — Dev Dependencies

| Package | Versi | Keterangan |
|---------|-------|------------|
| **pestphp/pest** | 3.8.4 | Framework testing modern untuk PHP |
| **laravel/sail** | 1.46.0 | Docker development environment |
| **laravel/pint** | 1.25.1 | Code style fixer otomatis (PSR-12) |
| **laravel/pail** | 1.2.3 | Log viewer real-time di terminal |
| **fakerphp/faker** | 1.24.1 | Generate data dummy untuk seeder |
| **barryvdh/laravel-ide-helper** | 3.6.0 | Autocomplete IDE untuk Laravel |

### Frontend

| Package | Versi | Keterangan |
|---------|-------|------------|
| **tailwindcss** | 4.1.11 | Utility-first CSS framework (v4 — tanpa config file) |
| **@tailwindcss/vite** | 4.1.11 | Plugin Tailwind v4 untuk Vite |
| **vite** | 7.1.9 | Asset bundler & dev server |
| **laravel-vite-plugin** | 2.0.0 | Integrasi Vite dengan Laravel |
| **axios** | 1.12.2 | HTTP client untuk request AJAX |
| **sweetalert2** | 11.26.2 | Library popup/dialog/notifikasi yang elegan |
| **autoprefixer** | 10.4.21 | PostCSS plugin vendor prefix CSS otomatis |
| **concurrently** | 9.2.0 | Jalankan server + queue + vite dalam satu terminal |

### Database
- **MySQL** 8.0+ atau **MariaDB** 10.6+

---

## 💻 Persyaratan Sistem

Pastikan laptop baru kamu sudah memiliki semua ini sebelum instalasi:

| Dependensi | Versi Wajib | Cara Cek |
|------------|-------------|----------|
| **PHP** | ≥ 8.2 | `php --version` |
| **Composer** | ≥ 2.x | `composer --version` |
| **Node.js** | ≥ 20.19.0 **atau** ≥ 22.12.0 | `node --version` |
| **NPM** | ≥ 10.x | `npm --version` |
| **MySQL** | ≥ 8.0 | `mysql --version` |
| **Git** | Terbaru | `git --version` |

> ⚠️ **PERHATIAN — Node.js:** `vite` v7 dan `laravel-vite-plugin` v2 membutuhkan Node.js **minimal 20.19.0 atau 22.12.0+**. Node.js 18 atau Node.js 20 versi lama **pasti error**. Update dulu sebelum lanjut via **[nodejs.org/en/download](https://nodejs.org/en/download)** (pilih versi LTS terbaru).

> 💡 **Rekomendasi local dev environment untuk Windows:** [Laragon](https://laragon.org/) (PHP + MySQL sudah bundled, paling mudah) atau [XAMPP](https://www.apachefriends.org/). Pastikan PHP versi 8.2+ yang aktif.

---

## 🚀 Instalasi & Setup

### Langkah 1 — Clone Repository

```bash
git clone https://github.com/Azemux26/E-Labsim.git
cd E-Labsim
```

---

### Langkah 2 — Siapkan Database

Buka phpMyAdmin atau MySQL client, lalu buat database baru:

```sql
CREATE DATABASE e_labsim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Langkah 3 — Salin File Environment

```bash
# Windows (Command Prompt / PowerShell)
copy .env.example .env

# Mac / Linux
cp .env.example .env
```

Buka file `.env` lalu sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_labsim      # ← nama database yang dibuat di langkah 2
DB_USERNAME=root           # ← sesuaikan
DB_PASSWORD=               # ← kosongkan jika tidak ada password
```

---

### Langkah 4 — Install Semua Dependensi

```bash
# Install dependensi PHP
composer install

# Install dependensi JavaScript
npm install
```

---

### Langkah 5 — Generate Application Key

```bash
php artisan key:generate
```

> Perintah ini mengisi nilai `APP_KEY` di file `.env` secara otomatis. Wajib dijalankan sekali.

---

### Langkah 6 — Migrasi Database & Isi Data Awal

```bash
php artisan migrate:fresh --seed
```

> `migrate:fresh --seed` = buat semua tabel dari awal + isi data awal (seeder).
> Gunakan perintah ini hanya saat **setup pertama kali**. Untuk laptop yang sudah pernah pakai project ini, gunakan `php artisan migrate` saja agar data tidak terhapus.

---

### Langkah 7 — Buat Symbolic Link Storage

```bash
php artisan storage:link
```

> Menghubungkan `storage/app/public` ke `public/storage` agar file upload bisa diakses dari browser.

---

### Langkah 8 — Build Asset Frontend

```bash
npm run build
```

> Project menggunakan **Tailwind CSS v4** yang **tidak memerlukan** `tailwind.config.js`. Jangan buat file tersebut secara manual — sudah ditangani otomatis oleh plugin `@tailwindcss/vite`.

---

## ▶️ Menjalankan Aplikasi

Setelah setup selesai, jalankan **satu perintah** ini:

```bash
composer run dev
```

Perintah ini otomatis menjalankan tiga proses bersamaan (via Concurrently):

| Proses | Perintah | Fungsi |
|--------|----------|--------|
| 🌐 Web Server | `php artisan serve` | Menjalankan aplikasi |
| 📬 Queue Worker | `php artisan queue:listen` | Memproses notifikasi & job |
| ⚡ Vite Dev Server | `npm run dev` | Hot reload CSS/JS |

Buka browser dan akses: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

> Untuk menghentikan semua proses, tekan `Ctrl + C` di terminal.

---

## ⚙️ Konfigurasi Environment

Bagian-bagian penting di file `.env` yang perlu diperhatikan:

```env
APP_NAME="e-LABSIM"
APP_ENV=local
APP_KEY=base64:...          # Terisi otomatis setelah php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

# ── Database ─────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_labsim
DB_USERNAME=root
DB_PASSWORD=

# ── Queue (WAJIB 'database' agar notifikasi berjalan) ─
QUEUE_CONNECTION=database

# ── Session ───────────────────────────────────────────
SESSION_DRIVER=database
SESSION_LIFETIME=120

# ── Email / Notifikasi ────────────────────────────────
# Untuk development, gunakan Mailtrap (gratis): https://mailtrap.io
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=             # Isi dari dashboard Mailtrap kamu
MAIL_PASSWORD=             # Isi dari dashboard Mailtrap kamu
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@e-labsim.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 👥 Struktur Role & Akses

Setelah `migrate:fresh --seed`, akun berikut tersedia untuk login:

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| **Admin** | admin@e-labsim.com | password | Full akses semua fitur & manajemen user |
| **Operator** | operator@e-labsim.com | password | Kelola jadwal & cetak laporan |
| **Dosen/Instruktur** | dosen@e-labsim.com | password | Ajukan & lihat jadwal |
| **Mahasiswa** | mahasiswa@e-labsim.com | password | Lihat jadwal & status booking |

> ⚠️ Sesuaikan tabel di atas dengan isi sebenarnya di `database/seeders/`. Ganti semua password default segera setelah login pertama kali di environment production.

---

## 📁 Struktur Direktori

```
E-Labsim/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controller utama
│   │   └── Middleware/         # Auth & role middleware
│   ├── Livewire/               # Livewire components
│   ├── Models/                 # Eloquent Models
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Skema tabel database
│   └── seeders/                # Data awal aplikasi
├── resources/
│   ├── views/
│   │   └── livewire/           # Blade views untuk Livewire components
│   ├── css/
│   │   └── app.css             # Entry point Tailwind CSS v4
│   └── js/
│       └── app.js              # Entry point JS (Axios, SweetAlert2)
├── routes/
│   └── web.php                 # Semua route aplikasi
├── storage/
│   └── app/public/             # File upload (dilink ke public/storage)
├── tests/                      # Test files (Pest PHP)
├── .env.example                # Template konfigurasi — JANGAN dihapus
├── composer.json               # Dependensi PHP & composer scripts
├── package.json                # Dependensi Node.js
├── vite.config.js              # Konfigurasi Vite + Tailwind
└── README.md
```

---

## 🧪 Menjalankan Test

Project ini menggunakan **Pest PHP** v3 sebagai testing framework.

```bash
# Jalankan semua test (via composer script — config:clear otomatis)
composer run test

# Atau langsung via artisan
php artisan test

# Jalankan test tertentu
php artisan test --filter=NamaTest
```

---

## 🔧 Perintah Berguna

```bash
# ── Menjalankan Aplikasi ──────────────────────────────
composer run dev                   # Server + Queue + Vite (DIREKOMENDASIKAN)
php artisan serve                  # Hanya web server saja

# ── Database ─────────────────────────────────────────
php artisan migrate                # Jalankan migrasi baru
php artisan migrate:fresh --seed   # Reset total & isi data awal
php artisan migrate:rollback       # Batalkan migrasi terakhir
php artisan db:seed                # Jalankan ulang seeder saja

# ── Cache & Config ────────────────────────────────────
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# ── Generate File ─────────────────────────────────────
php artisan make:model NamaModel -mcr     # Model + Migration + Controller
php artisan make:livewire NamaComponent   # Livewire component baru
php artisan make:migration nama_tabel     # File migration baru

# ── Info & Debug ─────────────────────────────────────
php artisan route:list             # Lihat semua route terdaftar
php artisan about                  # Info versi Laravel & environment
composer show --installed          # Lihat semua package PHP terinstall
```

---

## ❓ Troubleshooting

**Q: Error saat `npm install` — "engine" atau "unsupported engine"**
```
Node.js kamu terlalu lama. Wajib versi ≥ 20.19.0 atau ≥ 22.12.0.
```
```bash
node --version   # Cek versi sekarang
# Update via https://nodejs.org atau via nvm:
nvm install 22 && nvm use 22
npm install
```

---

**Q: Halaman putih / Error 500 setelah clone**
```bash
php artisan key:generate          # 1. APP_KEY harus ada
php artisan config:clear          # 2. Hapus cache config lama
php artisan migrate:fresh --seed  # 3. Pastikan tabel sudah dibuat
npm run build                     # 4. Build asset CSS/JS
```

---

**Q: Tampilan berantakan / tidak ada CSS sama sekali**
```bash
npm run build
# Atau jalankan composer run dev dan pastikan Vite dev server aktif
```

---

**Q: `queue:listen` error — tabel `jobs` tidak ada**
```bash
# Pastikan QUEUE_CONNECTION=database di .env, lalu:
php artisan queue:table
php artisan migrate
```

---

**Q: File upload / gambar tidak bisa diakses**
```bash
php artisan storage:link
```

---

**Q: Error `Class not found` atau autoload error**
```bash
composer dump-autoload
```

---

**Q: Error permission di Linux/Mac**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademik (Skripsi S1) di **Program Studi Sistem Informasi, Politeknik Maritim AMI Makassar**.

Didistribusikan di bawah [MIT License](LICENSE).

---

<div align="center">

**Dikembangkan dengan ❤️ untuk Politeknik Maritim AMI Makassar**

*© 2025 — e-LABSIM Project*

</div>
