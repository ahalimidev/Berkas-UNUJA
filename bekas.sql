-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table aturan.berkas
DROP TABLE IF EXISTS `berkas`;
CREATE TABLE IF NOT EXISTS `berkas` (
  `id_berkas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_unit` smallint(6) unsigned NOT NULL,
  `id_jenis_berkas` smallint(5) unsigned NOT NULL,
  `nama_berkas` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_berkas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_berkas` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_berkas`),
  KEY `id_unit` (`id_unit`),
  KEY `id_jenis_berkas` (`id_jenis_berkas`),
  CONSTRAINT `fk_berkas_jenis_berkas` FOREIGN KEY (`id_jenis_berkas`) REFERENCES `jenis_berkas` (`id_jenis_berkas`),
  CONSTRAINT `fk_berkas_unit` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.berkas: ~0 rows (approximately)
DELETE FROM `berkas`;

-- Dumping structure for table aturan.jenis_berkas
DROP TABLE IF EXISTS `jenis_berkas`;
CREATE TABLE IF NOT EXISTS `jenis_berkas` (
  `id_jenis_berkas` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_berkas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_jenis_berkas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.jenis_berkas: ~0 rows (approximately)
DELETE FROM `jenis_berkas`;

-- Dumping structure for table aturan.master_fakultas
DROP TABLE IF EXISTS `master_fakultas`;
CREATE TABLE IF NOT EXISTS `master_fakultas` (
  `id_fakultas` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singkatan_fakultas` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_fakultas`) USING BTREE,
  UNIQUE KEY `id_fakultas_UNIQUE` (`id_fakultas`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.master_fakultas: ~5 rows (approximately)
DELETE FROM `master_fakultas`;
INSERT INTO `master_fakultas` (`id_fakultas`, `nama_fakultas`, `singkatan_fakultas`) VALUES
	(1, 'Fakultas Agama Islam', 'FAI');
INSERT INTO `master_fakultas` (`id_fakultas`, `nama_fakultas`, `singkatan_fakultas`) VALUES
	(2, 'Fakultas Teknik', 'FT');
INSERT INTO `master_fakultas` (`id_fakultas`, `nama_fakultas`, `singkatan_fakultas`) VALUES
	(3, 'Fakultas Kesehatan', 'FKES');
INSERT INTO `master_fakultas` (`id_fakultas`, `nama_fakultas`, `singkatan_fakultas`) VALUES
	(4, 'Fakultas Sosial & Humaniora', 'SOSHUM');
INSERT INTO `master_fakultas` (`id_fakultas`, `nama_fakultas`, `singkatan_fakultas`) VALUES
	(5, 'Program Pascasarjana', 'Pasca');

-- Dumping structure for table aturan.master_lembaga
DROP TABLE IF EXISTS `master_lembaga`;
CREATE TABLE IF NOT EXISTS `master_lembaga` (
  `id_lembaga` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan_lembaga` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.master_lembaga: ~46 rows (approximately)
DELETE FROM `master_lembaga`;
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(1, 'Yayasan Nurul Jadid', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(2, 'Senat', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(3, 'Dewan Penyantun', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(4, 'Pimpinan Rektorat', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(5, 'Biro Administrasi Umum Akademik dan Kemahasiswaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(6, 'Bagian Administrasi Umum', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(7, 'Subbagian Administrasi Umum', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(8, 'Bagian Administrasi Akademik dan Kemahasiswaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(9, 'Subbagian Administrasi Kemahasiswaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(10, 'Subbagian Organisasi Kemahasiswaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(11, 'Subbagian Organisasi dan Pendataan Alumni', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(12, 'Bagian Perencanaan dan Keuangan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(13, 'Bagian Sarana dan Kerumah Tanggaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(14, 'Subbagian Pengadaan dan Pemeliharaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(15, 'Subbagian Kerumahtanggaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(16, 'Subbagian Kebersihan dan Keamanan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(17, 'Lembaga Penjaminan Mutu', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(18, 'Bidang Penjaminan Mutu', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(19, 'Subbidang Penjaminan Mutu', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(20, 'Lembaga Penerbitan, Penelitian, dan Pengabdian Masyarakat', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(21, 'Bidang Penerbitan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(22, 'Bidang Penelitian', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(23, 'Bidang Pengabdian Kepada Masyarakat', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(24, 'Lembaga Integrasi Kokurikuler', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(25, 'Bidang Integrasi Kokurikuler', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(26, 'Bidang Bahasa', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(27, 'Bidang Pengendali Mutu Keagamaan Mahasiswa', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(28, 'Bidang Pengendali Mutu Keagamaan I', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(29, 'Bidang Pengendali Mutu Keagamaan II', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(30, 'Bidang Pondok Mahasiswa/Mahasiswi', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(31, 'Bidang Pondok Mahasiswi', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(32, 'Lembaga Pusat Data dan Sistem Informasi', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(33, 'Lembaga Humas dan Protokoler', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(34, 'Bidang Pengembangan Image Kelembagaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(35, 'Bidang Pengembangan Kerjasama dan Jaringan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(36, 'Bidang Perluasan Publikasi dan Media Massa', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(37, 'Lembaga Pengembangan Profesionalitas dan Kewirausahaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(38, 'Sistem Pengawasan Internal', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(39, 'Badan Pengelola Lingkungan Kampus', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(40, 'Perpustakaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(41, 'Bagian Tata Usaha', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(42, 'Subbagian Administrasi Akademik dan Kemahasiswaan', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(43, 'Gugus Kendali Mutu', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(44, 'Bidang Sistem Informasi & Infrastruktur Jaringan Internet', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(45, 'Bidang Pelaporan Data PDDIKTI, Pedatren, & EMIS', NULL);
INSERT INTO `master_lembaga` (`id_lembaga`, `nama_lembaga`, `singkatan_lembaga`) VALUES
	(46, 'Lembaga Pengawasan dan Penjaminan Mutu', NULL);

-- Dumping structure for table aturan.master_prodi
DROP TABLE IF EXISTS `master_prodi`;
CREATE TABLE IF NOT EXISTS `master_prodi` (
  `prodi_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_fakultas` tinyint(3) unsigned NOT NULL,
  `program_studi` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singkatan` char(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`prodi_id`) USING BTREE,
  KEY `fk_master_prodi_master_fakultas1_idx` (`id_fakultas`) USING BTREE,
  CONSTRAINT `master_fak` FOREIGN KEY (`id_fakultas`) REFERENCES `master_fakultas` (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.master_prodi: ~24 rows (approximately)
DELETE FROM `master_prodi`;
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(1, 5, 'Pendidikan Agama Islam (S2)', 'PAI-S2');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(2, 5, 'Manajemen Pendidikan Islam (S2)', 'MPI-S2');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(3, 1, 'Pendidikan Agama Islam', 'PAI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(4, 1, 'Manajemen Pendidikan Islam', 'MPI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(5, 1, 'Ekonomi Syariah', 'ES');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(6, 1, 'Perbankan Syariah', 'PS');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(7, 1, 'Komunikasi & Penyiaran Islam', 'KPI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(8, 1, 'Ilmu Al-Qur`an & Tafsir', 'IQT');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(9, 1, 'Hukum Keluarga (Ahwal Syakhshiyah)', 'HK (AS)');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(10, 1, 'Pendidikan Guru Madrasah Ibtidaiyah', 'PGMI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(11, 1, 'Pendidikan Islam Anak Usia Dini', 'PIAUD');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(14, 1, 'Pendidikan Bahasa Arab', 'PBA');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(15, 2, 'Teknik Elektro', 'TE');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(16, 2, 'Informatika', 'IF');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(17, 2, 'Sistem Informasi', 'SI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(18, 2, 'Teknologi Informasi', 'TI');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(19, 2, 'Rekayasa Perangkat Lunak', 'RPL');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(20, 3, 'Kebidanan', 'KEB');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(21, 3, 'Keperawatan', 'KEP');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(22, 3, 'Profesi Ners', 'NERS');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(23, 4, 'Hukum', 'HK');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(24, 4, 'Ekonomi', 'EKN');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(25, 4, 'Pendidikan Matematika', 'MAT');
INSERT INTO `master_prodi` (`prodi_id`, `id_fakultas`, `program_studi`, `singkatan`) VALUES
	(26, 4, 'Pendidikan Bahasa Inggris', 'PBI');

-- Dumping structure for table aturan.struktur
DROP TABLE IF EXISTS `struktur`;
CREATE TABLE IF NOT EXISTS `struktur` (
  `id_struktur` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama_struktur` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_struktur`),
  KEY `id_struktur` (`id_struktur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.struktur: ~3 rows (approximately)
DELETE FROM `struktur`;
INSERT INTO `struktur` (`id_struktur`, `nama_struktur`) VALUES
	(1, 'Lembaga');
INSERT INTO `struktur` (`id_struktur`, `nama_struktur`) VALUES
	(2, 'Fakultas');
INSERT INTO `struktur` (`id_struktur`, `nama_struktur`) VALUES
	(3, 'Fakultas & Prodi');

-- Dumping structure for table aturan.sub_berkas
DROP TABLE IF EXISTS `sub_berkas`;
CREATE TABLE IF NOT EXISTS `sub_berkas` (
  `id_sub_berkas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_berkas` int(10) unsigned NOT NULL,
  `id_unit` smallint(6) unsigned NOT NULL,
  `nama_sub_berkas` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_berkas` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_sub_berkas`),
  KEY `id_berkas` (`id_berkas`),
  KEY `id_unit` (`id_unit`),
  KEY `id_sub_berkas` (`id_sub_berkas`),
  CONSTRAINT `fk_sub_berkas_berkas` FOREIGN KEY (`id_berkas`) REFERENCES `berkas` (`id_berkas`),
  CONSTRAINT `fk_sub_berkas_unit` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.sub_berkas: ~0 rows (approximately)
DELETE FROM `sub_berkas`;

-- Dumping structure for table aturan.unit
DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_lembaga` smallint(4) unsigned DEFAULT NULL,
  `id_fakultas` tinyint(3) unsigned DEFAULT NULL,
  `id_prodi` tinyint(3) unsigned DEFAULT NULL,
  `id_struktur` tinyint(3) unsigned NOT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_unit`),
  KEY `fk_unit_lembaga` (`id_lembaga`),
  KEY `fk_unit_fakultas` (`id_fakultas`),
  KEY `fk_unit_prodi` (`id_prodi`),
  KEY `fk_unit_stuktur` (`id_struktur`),
  KEY `id_unit` (`id_unit`),
  CONSTRAINT `fk_unit_fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `master_fakultas` (`id_fakultas`),
  CONSTRAINT `fk_unit_lembaga` FOREIGN KEY (`id_lembaga`) REFERENCES `master_lembaga` (`id_lembaga`),
  CONSTRAINT `fk_unit_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `master_prodi` (`prodi_id`),
  CONSTRAINT `fk_unit_stuktur` FOREIGN KEY (`id_struktur`) REFERENCES `struktur` (`id_struktur`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.unit: ~75 rows (approximately)
DELETE FROM `unit`;
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(1, 1, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(2, 2, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(3, 3, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(4, 4, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(5, 5, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(6, 6, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(7, 7, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(8, 8, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(9, 9, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(10, 10, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(11, 11, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(12, 12, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(13, 13, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(14, 14, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(15, 15, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(16, 16, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(17, 17, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(18, 18, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(19, 19, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(20, 20, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(21, 21, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(22, 22, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(23, 23, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(24, 24, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(25, 25, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(26, 26, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(27, 27, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(28, 28, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(29, 29, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(30, 30, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(31, 31, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(32, 32, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(33, 33, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(34, 34, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(35, 35, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(36, 36, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(37, 37, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(38, 38, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(39, 39, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(40, 40, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(41, 41, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(42, 42, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(43, 43, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(44, 44, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(45, 45, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(46, 46, NULL, NULL, 1, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(47, NULL, 1, NULL, 2, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(48, NULL, 2, NULL, 2, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(49, NULL, 3, NULL, 2, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(50, NULL, 4, NULL, 2, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(51, NULL, 5, NULL, 2, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(52, NULL, 5, 1, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(53, NULL, 5, 2, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(54, NULL, 1, 3, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(55, NULL, 1, 4, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(56, NULL, 1, 5, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(57, NULL, 1, 6, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(58, NULL, 1, 7, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(59, NULL, 1, 8, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(60, NULL, 1, 9, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(61, NULL, 1, 10, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(62, NULL, 1, 11, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(63, NULL, 1, 14, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(64, NULL, 2, 15, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(65, NULL, 2, 16, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(66, NULL, 2, 17, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(67, NULL, 2, 18, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(68, NULL, 2, 19, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(69, NULL, 3, 20, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(70, NULL, 3, 21, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(71, NULL, 3, 22, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(72, NULL, 4, 23, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(73, NULL, 4, 24, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(74, NULL, 4, 25, 3, 'active');
INSERT INTO `unit` (`id_unit`, `id_lembaga`, `id_fakultas`, `id_prodi`, `id_struktur`, `status`) VALUES
	(75, NULL, 4, 26, 3, 'active');

-- Dumping structure for table aturan.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` smallint(6) unsigned NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_user`),
  KEY `id_unit` (`id_unit`),
  CONSTRAINT `fk_user_unit` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aturan.user: ~0 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `id_unit`, `nama`, `username`, `password`, `create_by`, `create_date`, `update_by`, `update_date`, `status`) VALUES
	(1, 32, 'Ahmad Halimi', 'halimi', '$2y$10$xeQ7/9YKFZ4F5cNv2jXD1OuM/NQzgqNphKiQ4AENWdM5XHikpn0VO', NULL, NULL, 'Ahmad Halimi', '2022-12-05 10:46:22', 'active');

-- Dumping structure for view aturan.v_berkas
DROP VIEW IF EXISTS `v_berkas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_berkas` (
	`id_berkas` INT(10) UNSIGNED NOT NULL,
	`id_unit` SMALLINT(6) UNSIGNED NOT NULL,
	`nama_unit` MEDIUMTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_struktur` VARCHAR(32) NULL COLLATE 'utf8mb4_unicode_ci',
	`id_jenis_berkas` SMALLINT(5) UNSIGNED NOT NULL,
	`nama_jenis_berkas` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_berkas` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`keterangan_berkas` TEXT NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`berkas` VARCHAR(32) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`status_berkas` ENUM('y','n') NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`create_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`create_date` DATETIME NULL,
	`update_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`update_date` DATETIME NULL,
	`status` ENUM('active','block') NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view aturan.v_sub_berkas
DROP VIEW IF EXISTS `v_sub_berkas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_sub_berkas` (
	`id_sub_berkas` INT(10) UNSIGNED NOT NULL,
	`id_unit` SMALLINT(6) UNSIGNED NOT NULL,
	`id_berkas` INT(10) UNSIGNED NOT NULL,
	`sub_nama_unit` MEDIUMTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`sub_nama_struktur` VARCHAR(32) NULL COLLATE 'utf8mb4_unicode_ci',
	`sub_berkas` VARCHAR(32) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_sub_berkas` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_unit` MEDIUMTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_struktur` VARCHAR(32) NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_berkas` VARCHAR(150) NULL COLLATE 'utf8mb4_unicode_ci',
	`keterangan_berkas` TEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_jenis_berkas` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`berkas` VARCHAR(32) NULL COLLATE 'utf8mb4_unicode_ci',
	`status_berkas` ENUM('y','n') NULL COLLATE 'utf8mb4_unicode_ci',
	`create_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`create_date` DATETIME NULL,
	`update_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`update_date` DATETIME NULL,
	`status` ENUM('active','block') NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view aturan.v_unit
DROP VIEW IF EXISTS `v_unit`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_unit` (
	`id_unit` SMALLINT(6) UNSIGNED NOT NULL,
	`nama_unit` MEDIUMTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`id_struktur` TINYINT(3) UNSIGNED NOT NULL,
	`nama_struktur` VARCHAR(32) NULL COLLATE 'utf8mb4_unicode_ci',
	`status` VARCHAR(6) NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view aturan.v_user
DROP VIEW IF EXISTS `v_user`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_user` (
	`id_user` INT(11) NOT NULL,
	`id_unit` SMALLINT(6) UNSIGNED NOT NULL,
	`nama_unit` MEDIUMTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`nama` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`username` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`create_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`create_date` DATETIME NULL,
	`update_by` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`update_date` DATETIME NULL,
	`status` ENUM('active','block') NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view aturan.v_berkas
DROP VIEW IF EXISTS `v_berkas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_berkas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_berkas` AS SELECT berkas.id_berkas,
berkas.id_unit,
v_unit.nama_unit,
v_unit.nama_struktur,
berkas.id_jenis_berkas,
jenis_berkas.nama_jenis_berkas,
berkas.nama_berkas,
berkas.keterangan_berkas,
berkas.berkas,
berkas.status_berkas,
berkas.create_by,
berkas.create_date,
berkas.update_by,
berkas.update_date,
berkas.status
FROM berkas
LEFT JOIN v_unit on v_unit.id_unit = berkas.id_unit
LEFT JOIN jenis_berkas on jenis_berkas.id_jenis_berkas = berkas.id_jenis_berkas ;

-- Dumping structure for view aturan.v_sub_berkas
DROP VIEW IF EXISTS `v_sub_berkas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_sub_berkas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_sub_berkas` AS SELECT 
sub_berkas.id_sub_berkas,
sub_berkas.id_unit,
sub_berkas.id_berkas,
v_unit.nama_unit as sub_nama_unit,
v_unit.nama_struktur sub_nama_struktur,
sub_berkas.sub_berkas,
sub_berkas.nama_sub_berkas,
v_berkas.nama_unit,
v_berkas.nama_struktur,
v_berkas.nama_berkas,
v_berkas.keterangan_berkas,
v_berkas.nama_jenis_berkas,
v_berkas.berkas,
v_berkas.status_berkas,
sub_berkas.create_by,
sub_berkas.create_date,
sub_berkas.update_by,
sub_berkas.update_date,
sub_berkas.status
FROM sub_berkas
LEFT JOIN v_unit on v_unit.id_unit = sub_berkas.id_unit
LEFT join v_berkas on v_berkas.id_berkas = sub_berkas.id_berkas ;

-- Dumping structure for view aturan.v_unit
DROP VIEW IF EXISTS `v_unit`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_unit`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_unit` AS (SELECT unit.id_unit, master_lembaga.nama_lembaga AS nama_unit, unit.id_struktur, struktur.nama_struktur, unit.status 
 FROM unit 
 LEFT JOIN master_lembaga on master_lembaga.id_lembaga = unit.id_lembaga 
 LEFT JOIN struktur ON struktur.id_struktur = unit.id_struktur
 WHERE unit.id_struktur = 1)

UNION ALL

(SELECT unit.id_unit, master_fakultas.nama_fakultas AS nama_unit, unit.id_struktur, struktur.nama_struktur, unit.status 
 FROM unit 
 LEFT JOIN master_fakultas on master_fakultas.id_fakultas = unit.id_fakultas 
 LEFT JOIN struktur ON struktur.id_struktur = unit.id_struktur
 WHERE unit.id_struktur = 2)
 
UNION ALL

(SELECT unit.id_unit, GROUP_CONCAT(master_fakultas.nama_fakultas,' - ',master_prodi.program_studi) AS nama_unit, unit.id_struktur, struktur.nama_struktur, unit.status 
 FROM unit 
 LEFT JOIN master_fakultas on master_fakultas.id_fakultas = unit.id_fakultas 
 LEFT JOIN master_prodi on master_prodi.prodi_id = unit.id_prodi 
 LEFT JOIN struktur ON struktur.id_struktur = unit.id_struktur
 WHERE unit.id_struktur = 3
 GROUP BY unit.id_prodi) ;

-- Dumping structure for view aturan.v_user
DROP VIEW IF EXISTS `v_user`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_user`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_user` AS SELECT user.id_user,user.id_unit,v_unit.nama_unit, user.nama,user.username,user.password,user.create_by,user.create_date,user.update_by,user.update_date,user.status 
FROM user
LEFT JOIN v_unit on v_unit.id_unit = user.id_unit ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
