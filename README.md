# Sistem Informasi Pengaduan Masyarakat

Sistem berbasis web untuk menangani pengaduan masyarakat. Dibangun dengan Laravel dan Filament Admin Panel.

## Fitur

-   Autentikasi Pengguna
-   CRUD Kategori Pengaduan, Pengaduan, & Data Masyarakat
-   Pengelola Pengaduan:
    -   Pengaduan Masuk
    -   Pengaduan Diproses
    -   Pengaduan Selesai
    -   Pengaduan Ditolak
-   Dashboard Statistik
-   Soft Delete dan Riwayat

## Tech Stack

-   Laravel 12
-   PHP 8.2+
-   MySQL
-   Filament v3

## Plugins Filament

-   [Character Counter by Tally Schmeits](https://filamentphp.com/plugins/tallyschmeits-character-counter)
-   [Nord Theme by Andréia Bohner](https://filamentphp.com/plugins/andreia-bohner-nord-theme)
-   [Resized Column by Asmit Nepali](https://filamentphp.com/plugins/asmit-nepali-resized-column)
-   [Excel Import by Eighty Nine](https://filamentphp.com/plugins/eightynine-excel-import)
-   [Apex Charts by Leandro Ferreira](https://filamentphp.com/plugins/leandrocfe-apex-charts)
-   [Excel Export by Dennis Koch](https://filamentphp.com/plugins/pxlrbt-excel)
-   [Backgrounds by SWIS](https://filamentphp.com/plugins/swisnl-backgrounds)

## Installation

### 1. Clone repository

```bash
git clone https://github.com/username/sistem-informamsi-pengaduan-masyarakat.git
cd sistem-informamsi-pengaduan-masyarakat
```

### 2. Install dependensi

```bash
composer install
```

### 3. Salin file .env

```bash
cp .env.example .env
```

### 4. Generate key aplikasi

```bash
php artisan key:generate
```

### 5. Konfigurasi database

```bash
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan migrasi & seeder (opsional)

```bash
php artisan migrate --seed
```

### 7. Jalankan server lokal

```bash
php artisan serve
```

## Akun Demo

```bash
Role      = Admin
Email     = admin@example.com
Password  = admin123
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
