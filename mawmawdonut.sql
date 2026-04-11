-- ============================================
-- DATABASE: mawmawdonut
-- Dibuat dari migration Laravel
-- Hanya tabel utama: users, tbl_kategori, tbl_produk, tbl_profile_perusahaan
-- Tipe data ID menggunakan INT(10) sesuai permintaan
-- ============================================

CREATE DATABASE IF NOT EXISTS mawmawdonut;
USE mawmawdonut;

-- ============================================
-- 1. TABEL USERS (Admin & Superadmin)
-- ============================================
CREATE TABLE `users` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'superadmin') NOT NULL DEFAULT 'admin',
    `remember_token` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. TABEL KATEGORI PRODUK
-- ============================================
CREATE TABLE `tbl_kategori` (
    `id_kategori` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama_kategori` VARCHAR(100) NOT NULL,
    `gambar` VARCHAR(255) DEFAULT NULL COMMENT 'Path gambar di storage/public',
    `status` ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    `jumlah_produk` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Auto-sync via ProdukController',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. TABEL PRODUK
-- ============================================
CREATE TABLE `tbl_produk` (
    `id_produk` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama_produk` VARCHAR(150) NOT NULL,
    `id_kategori` INT(10) UNSIGNED NOT NULL,
    `harga` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    `deskripsi` TEXT DEFAULT NULL,
    `gambar` VARCHAR(255) DEFAULT NULL COMMENT 'Path gambar di storage/public',
    `status` ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id_produk`),
    KEY `idx_status_kategori` (`status`, `id_kategori`),
    CONSTRAINT `tbl_produk_id_kategori_foreign`
        FOREIGN KEY (`id_kategori`)
        REFERENCES `tbl_kategori` (`id_kategori`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. TABEL PROFILE PERUSAHAAN
-- ============================================
CREATE TABLE `tbl_profile_perusahaan` (
    `id_profile` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama_perusahaan` VARCHAR(150) NOT NULL,
    `alamat` TEXT DEFAULT NULL,
    `telepon` VARCHAR(20) DEFAULT NULL,
    `email` VARCHAR(100) DEFAULT NULL,
    `deskripsi` TEXT DEFAULT NULL COMMENT 'Deskripsi singkat untuk halaman beranda',
    `sejarah` LONGTEXT DEFAULT NULL COMMENT 'Konten halaman Tentang Kami',
    `logo` VARCHAR(255) DEFAULT NULL COMMENT 'Path logo di storage/public',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- DATA AWAL: Superadmin default
-- ============================================
-- Password: password123
-- Jalankan di Laravel tinker untuk generate bcrypt hash yang benar:
-- php artisan tinker
-- >>> bcrypt('password123')
-- Lalu ganti hash di bawah ini dengan hasilnya.
INSERT INTO `users` (`name`, `username`, `password`, `role`) VALUES
('Super Admin', 'superadmin', '$2y$12$LQv3c1yqB1HoM0ARL1J5IOStS7gR0F1G3Z9C0Q9pE4x5w7K8m0Sy', 'superadmin');

-- ============================================
-- DATA CONTOH: Profile Perusahaan
-- ============================================
INSERT INTO `tbl_profile_perusahaan` (`nama_perusahaan`, `alamat`, `telepon`, `email`, `deskripsi`, `sejarah`) VALUES
('MawMaw Donut', 'Jl. Contoh Alamat No. 123', '081234567890', 'info@mawmawdonut.com', 'Donat lezat dengan berbagai varian rasa.', 'Sejarah perusahaan...');

-- ============================================
-- DATA CONTOH: Kategori
-- ============================================
INSERT INTO `tbl_kategori` (`nama_kategori`, `status`, `jumlah_produk`) VALUES
('Donat Original', 'aktif', 0),
('Donat Premium', 'aktif', 0),
('Minuman', 'aktif', 0);