-- ============================================================
-- Database: db_rt01
-- Website Profile Desa RT 01 — CodeIgniter 3
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_rt01 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_rt01;

-- ============================================================
-- Tabel: berita
-- ============================================================
CREATE TABLE IF NOT EXISTS `berita` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(300) NOT NULL UNIQUE,
  `konten` TEXT NOT NULL,
  `gambar` VARCHAR(255) DEFAULT NULL,
  `kategori` VARCHAR(100) DEFAULT NULL,
  `tanggal` DATE NOT NULL,
  `status` ENUM('publish','draft') NOT NULL DEFAULT 'draft',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Tabel: agenda
-- ============================================================
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT DEFAULT NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME DEFAULT NULL,
  `lokasi` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('upcoming','done') NOT NULL DEFAULT 'upcoming',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tanggal` (`tanggal`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Tabel: admin
-- ============================================================
CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Data Default: Admin
-- Username: admin | Password: admin123
-- ============================================================
-- Password: admin123
INSERT INTO `admin` (`username`, `password`, `nama`) VALUES
('admin', '$2y$10$TKh8H1.PfYi1ll5Z4N7Z3.O2zqVmEjb8Y6z35V4bVb5liqW5/yZKi', 'Ketua RT 01');
-- Hash di atas adalah untuk password 'admin123'
-- Untuk generate hash baru: jalankan http://localhost/jawa/setup_admin.php

-- ============================================================
-- Data Contoh: Berita
-- ============================================================
INSERT INTO `berita` (`judul`, `slug`, `konten`, `kategori`, `tanggal`, `status`) VALUES
('Kerja Bakti Bersih Lingkungan RT 01', 'kerja-bakti-bersih-lingkungan-rt01-1', 'Warga RT 01 RW 05 Desa Sejahtera dengan antusias mengikuti kegiatan kerja bakti bersih lingkungan yang diadakan pada hari Minggu pagi. Kegiatan ini bertujuan untuk menjaga kebersihan dan kenyamanan lingkungan sekitar.\n\nSebanyak 45 kepala keluarga turut berpartisipasi dalam kegiatan yang berlangsung selama 3 jam ini. Dengan semangat gotong royong, warga membersihkan selokan, merapikan tanaman, dan mengecat pagar jalan.\n\nKetua RT 01, Bapak Suyatno, menyampaikan rasa terima kasih kepada seluruh warga yang telah berpartisipasi aktif. Kegiatan seperti ini diharapkan dapat terus berlanjut setiap bulannya.', 'Kegiatan', '2025-05-01', 'publish'),

('Posyandu Balita Bulan Mei 2025', 'posyandu-balita-mei-2025-2', 'Kegiatan Posyandu Balita RT 01 bulan Mei 2025 telah berjalan dengan lancar. Sebanyak 32 balita datang untuk mendapatkan pelayanan kesehatan rutin meliputi penimbangan berat badan, pemberian vitamin A, dan imunisasi.\n\nTim kesehatan dari Puskesmas Kecamatan Makmur turut hadir memberikan penyuluhan gizi kepada para ibu balita. Penyuluhan ini mencakup cara pemberian MPASI yang tepat dan pentingnya ASI eksklusif.\n\nBagi warga yang belum sempat hadir, Posyandu berikutnya akan diadakan bulan Juni 2025. Harap segera menghubungi kader Posyandu setempat untuk informasi lebih lanjut.', 'Kesehatan', '2025-05-03', 'publish'),

('Pengumuman Iuran Warga Bulan Mei', 'pengumuman-iuran-warga-mei-3', 'Bersama ini kami informasikan kepada seluruh warga RT 01 RW 05 bahwa iuran warga bulan Mei 2025 telah jatuh tempo.\n\nBesaran iuran tetap sama seperti bulan sebelumnya, yaitu Rp 20.000 per kepala keluarga per bulan. Iuran dapat dibayarkan langsung kepada Bendahara RT atau melalui transfer ke rekening RT.\n\nPembayaran diharapkan paling lambat tanggal 10 Mei 2025. Dana iuran ini digunakan untuk operasional RT, kebersihan lingkungan, dan keperluan sosial warga. Terima kasih atas partisipasi dan kepatuhan Bapak/Ibu sekalian.', 'Pengumuman', '2025-05-04', 'publish');

-- ============================================================
-- Data Contoh: Agenda
-- ============================================================
INSERT INTO `agenda` (`judul`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `status`) VALUES
('Rapat Bulanan RT 01', 'Rapat rutin bulanan untuk membahas program kerja RT, laporan keuangan, dan aspirasi warga. Seluruh kepala keluarga diharapkan hadir tepat waktu.\n\nAgenda rapat:\n1. Pembukaan\n2. Laporan keuangan bulan lalu\n3. Program kerja bulan ini\n4. Aspirasi warga\n5. Penutup', '2025-05-15', '19:30:00', 'Balai RT 01', 'upcoming'),

('Posyandu Balita Bulan Juni', 'Kegiatan Posyandu rutin untuk balita usia 0-5 tahun. Layanan meliputi: penimbangan berat badan, pengukuran tinggi badan, pemberian vitamin, dan konsultasi gizi bersama kader posyandu.', '2025-06-05', '08:00:00', 'Rumah Kader Posyandu Bu Siti', 'upcoming'),

('Kerja Bakti Rutin Juni', 'Kerja bakti rutin bulanan untuk membersihkan lingkungan RT 01. Mari bersama-sama menjaga kebersihan dan keindahan lingkungan kita. Harap membawa peralatan kebersihan masing-masing.', '2025-06-08', '07:00:00', 'Seluruh area RT 01', 'upcoming'),

('Peringatan Hari Kartini RT 01', 'Peringatan Hari Kartini dengan berbagai kegiatan lomba untuk ibu-ibu dan anak-anak. Kegiatan meliputi lomba memasak, lomba busana daerah, dan penampilan seni dari anak-anak RT 01.', '2025-04-21', '08:00:00', 'Lapangan RT 01', 'done'),

('Gotong Royong Pengecatan Pagar', 'Kegiatan pengecatan pagar jalan masuk RT 01 dalam rangka memperindah lingkungan. Kegiatan telah berjalan lancar dengan partisipasi aktif seluruh warga.', '2025-04-10', '07:30:00', 'Jalan Masuk RT 01', 'done');
