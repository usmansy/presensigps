-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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

-- Dumping structure for table presensigps.departemen
CREATE TABLE IF NOT EXISTS `departemen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_dept` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_dept` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table presensigps.departemen: ~4 rows (approximately)
INSERT INTO `departemen` (`id`, `kode_dept`, `nama_dept`) VALUES
	(1, 'STF', 'Staf'),
	(2, 'STP', 'Satpam'),
	(3, 'OUT', 'Outsourcing'),
	(4, 'PKL', 'Praktek Kerja Lapangan');

-- Dumping structure for table presensigps.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `kode_dept` char(3) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table presensigps.karyawan: ~6 rows (approximately)
INSERT INTO `karyawan` (`id`, `nik`, `username`, `nama_lengkap`, `jabatan`, `no_hp`, `foto`, `kode_dept`, `password`, `remember_token`) VALUES
	(1, '12345', 'usman', 'Usman Syarifuddin', 'Pramubakti', '085729188882', 'usman.png', 'STF', '$2y$10$xwdzLif70KMxEkyau4k8F.fjBkhJ5gCY56E2m8IMIhJqi7TSdZey.', NULL),
	(2, '12346', 'nela', 'Nela Maliana', 'PPSPM', NULL, NULL, 'STF', '$2a$12$4MuX9lyhyIXjRgLSNiptX.vXWMlmAr61.GmSMiQsK8F0YyZuWGQbO', NULL),
	(3, '12347', 'novi', 'Novi Aggiyanti', 'Sekretaris', NULL, NULL, 'STF', '$2a$12$4MuX9lyhyIXjRgLSNiptX.vXWMlmAr61.GmSMiQsK8F0YyZuWGQbO', NULL),
	(4, '12348', 'ato', 'Ato Kuswanto', 'Outsource', NULL, NULL, 'OUT', '$2a$12$4MuX9lyhyIXjRgLSNiptX.vXWMlmAr61.GmSMiQsK8F0YyZuWGQbO', NULL),
	(5, '12349', 'nanang', 'Nanang', 'Satpam', '082231564644', NULL, 'STP', '$2y$10$wMO2G/.9JFJuYiMq3JUoCeZUUKscxtTd1qc6JewzY6zqFhFch7m2e', NULL),
	(6, '12351', 'yani', 'Yani Anjani', 'Keuangan', '08231646325', 'yani.jpg', 'STF', '$2y$10$nttsyECv6p5LJsR1fUjdsOg7xNNZAOjBJDd.QiEKrHIJ5Qku/C8V.', NULL);

-- Dumping structure for table presensigps.konfigurasi_lokasi
CREATE TABLE IF NOT EXISTS `konfigurasi_lokasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lokasi_kantor` varchar(255) DEFAULT NULL,
  `radius` smallint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table presensigps.konfigurasi_lokasi: ~0 rows (approximately)
INSERT INTO `konfigurasi_lokasi` (`id`, `lokasi_kantor`, `radius`) VALUES
	(1, '-6.211357336591274, 106.84457854232978', 20);

-- Dumping structure for table presensigps.pengajuan_izin
CREATE TABLE IF NOT EXISTS `pengajuan_izin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `tgl_izin` date NOT NULL,
  `status` char(1) NOT NULL COMMENT 'i:izin s:sakit',
  `keterangan` varchar(255) NOT NULL,
  `status_approved` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0:pending 1:Disetujui 2:Ditolak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table presensigps.pengajuan_izin: ~4 rows (approximately)
INSERT INTO `pengajuan_izin` (`id`, `username`, `tgl_izin`, `status`, `keterangan`, `status_approved`) VALUES
	(1, 'usman', '2023-09-26', 's', 'Sakit flu pilek', '0'),
	(2, 'usman', '2023-09-25', 'i', 'Izin mengantar istri', '1'),
	(3, 'usman', '2023-09-27', 'd', 'Dinas Luar ke Dinas Kesehatan Pangandaran', '2'),
	(4, 'nela', '2023-09-26', 's', 'Sakit flu', '1');

-- Dumping structure for table presensigps.presensi
CREATE TABLE IF NOT EXISTS `presensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tgl_presensi` date DEFAULT NULL,
  `jam_in` time DEFAULT NULL,
  `jam_out` time DEFAULT NULL,
  `foto_in` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto_out` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `location_in` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `location_out` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table presensigps.presensi: ~7 rows (approximately)
INSERT INTO `presensi` (`id`, `nik`, `username`, `tgl_presensi`, `jam_in`, `jam_out`, `foto_in`, `foto_out`, `location_in`, `location_out`) VALUES
	(1, '12345', 'usman', '2023-09-25', '07:37:02', '11:43:54', 'usman-2023-09-25-in.png', 'usman-2023-09-25-out.png', '-7.67356,108.679095', '-7.67356025,108.679095'),
	(2, '12345', 'usman', '2023-09-24', '06:40:04', '11:41:13', 'usman-2023-09-24-in.png', 'usman-2023-09-24-out.png', '-7.67356025,108.679095', '-7.67356025,108.679095'),
	(3, '12346', 'nela', '2023-09-25', '07:08:10', '16:15:34', 'nela-2023-09-25-in.png', 'usman-2023-09-24-out.png', '-7.673562,108.679099', NULL),
	(4, '12345', 'usman', '2023-09-26', '07:12:58', NULL, 'usman-2023-09-26-in.png', NULL, '-7.67356025,108.679095', NULL),
	(5, '12349', 'nanang', '2023-09-27', '11:14:33', NULL, 'nanang-2023-09-27-in.png', NULL, '-7.67356025,108.679095', NULL),
	(6, '12349', 'nanang', '2023-09-29', NULL, '16:19:39', '', 'nanang-2023-09-27-in.png', NULL, NULL),
	(7, '12345', 'usman', '2023-10-02', '08:53:12', NULL, 'usman-2023-10-02-in.png', NULL, '-7.673562,108.679099', NULL);

-- Dumping structure for table presensigps.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table presensigps.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@mail.com', NULL, '$2a$12$EzLlLTsIJkCohVNqGtcrnu5b/4pQfFv7n5HsoNHB4ssYHDEpHIrhK', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
