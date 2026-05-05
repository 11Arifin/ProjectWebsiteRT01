# Website Profile Desa RT 01 — CodeIgniter 3

Website profil resmi RT 01 RW 05 Desa Sejahtera menggunakan framework **CodeIgniter 3**.

---

## ⚙️ Persyaratan

- PHP 7.4+ / 8.x
- MySQL 5.7+ / MariaDB
- XAMPP / Laragon / WAMP
- Apache dengan `mod_rewrite` aktif

---

## 🚀 Cara Instalasi

### 1. Download CodeIgniter 3
Download CI3 dari [https://codeigniter.com/download](https://codeigniter.com/download) dan ekstrak sehingga folder `system/` dan `index.php` berada satu level dengan folder `application/`.

Struktur akhir:
```
jawa/
├── application/   ← folder ini sudah ada
├── system/        ← download dari CI3
├── assets/        ← folder ini sudah ada
├── index.php      ← download dari CI3
├── .htaccess      ← sudah ada
└── database.sql   ← sudah ada
```

### 2. Setup Database
1. Buka **phpMyAdmin** → buat database baru: `db_rt01`
2. Import file `database.sql` ke database tersebut
3. Sesuaikan kredensial di `application/config/database.php` jika perlu

### 3. Konfigurasi
Edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/htdocs/jawa/';
```
Sesuaikan jika nama folder berbeda.

### 4. Aktifkan mod_rewrite
Pastikan `AllowOverride All` aktif di `httpd.conf` Apache:
```apache
<Directory "C:/xampp/htdocs">
    AllowOverride All
</Directory>
```

### 5. Jalankan
Buka browser: **http://localhost/htdocs/jawa/**

---

## 🔐 Login Admin

- **URL**: http://localhost/jawa/admin/login
- **Username**: `admin`
- **Password**: `password`

> ⚠️ **Ganti password segera setelah login pertama!**

Untuk generate password hash baru, buat file PHP sementara:
```php
<?php echo password_hash('password_baru_anda', PASSWORD_DEFAULT); ?>
```
Salin hash dan update di tabel `admin` via phpMyAdmin.

---

## 📋 Fitur

| Fitur | Deskripsi |
|-------|-----------|
| **Beranda** | Hero section, statistik, berita terbaru, agenda upcoming |
| **Berita** | Daftar berita + pencarian + pagination + detail |
| **Agenda** | Agenda mendatang & yang sudah selesai + detail |
| **Admin Login** | Autentikasi session CI3 yang aman |
| **Admin Dashboard** | Statistik konten dan ringkasan |
| **CRUD Berita** | Tambah, edit, hapus berita + upload gambar |
| **CRUD Agenda** | Tambah, edit, hapus agenda kegiatan |

---

## 🎨 Design

- **Warna**: Hijau hangat `#2d6a4f` + Krem `#fefae0`
- **Font**: Poppins + Merriweather (Google Fonts)
- **Animasi**: IntersectionObserver, counter animation
- **Responsif**: Mobile-friendly

---

## 📁 Struktur

```
application/
├── config/         → Konfigurasi CI3
├── controllers/    → Home, Berita, Agenda, Admin
├── models/         → Berita_model, Agenda_model
└── views/
    ├── templates/  → header.php, footer.php
    ├── home/       → Halaman beranda
    ├── berita/     → Daftar & detail berita
    ├── agenda/     → Daftar & detail agenda
    └── admin/      → Login, dashboard, CRUD

assets/
├── css/            → style.css, admin.css
├── js/             → main.js
└── img/
    └── berita/     → Upload gambar berita (auto-created)
```
