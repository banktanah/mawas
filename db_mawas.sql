-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 09:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mawas`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `akses_id` int(11) NOT NULL,
  `akses_role` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `apps_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`akses_id`, `akses_role`, `user_id`, `apps_id`, `created_at`, `edited_at`, `deleted_at`) VALUES
(11, 'Admin', 37, 10, '2023-05-08 14:38:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `apps_id` int(11) NOT NULL,
  `apps_nama` varchar(100) DEFAULT NULL,
  `apps_url` varchar(255) DEFAULT NULL,
  `apps_desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`apps_id`, `apps_nama`, `apps_url`, `apps_desc`, `created_at`, `edited_at`, `deleted_at`) VALUES
(3, 'Arsip Digital', 'http://202.146.130.230/arsip_banktanah/', 'Penyimpanan arsip digital', '2022-12-28 17:30:12', NULL, NULL),
(10, 'INSTAPRO', 'http://localhost/instapro/', 'Informasi Dan Status Perolehan Tanah', '2023-05-04 13:35:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deputi`
--

CREATE TABLE `deputi` (
  `deputi_id` int(11) NOT NULL,
  `deputi_nama` varchar(100) NOT NULL,
  `deputi_deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deputi`
--

INSERT INTO `deputi` (`deputi_id`, `deputi_nama`, `deputi_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(1, 'DEPUTI BIDANG PERENCANAAN STRATEGIS DAN PENGADAAN TANAH', '', '2023-03-08 09:56:54', '2023-05-08 17:08:41', NULL),
(2, 'DEPUTI BIDANG PENGELOLAAN DAN PENGEMBANGAN TANAH', '', '2023-03-08 09:56:54', '2023-05-08 17:08:33', NULL),
(3, 'DEPUTI BIDANG PEMANFAATAN TANAH DAN KERJA SAMA USAHA', '', '2023-03-08 09:56:54', '2023-05-08 17:08:48', NULL),
(4, 'DEPUTI BIDANG KEUANGAN DAN UMUM', '', '2023-03-08 09:56:54', '2023-05-08 17:08:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `divisi_id` int(11) NOT NULL,
  `divisi_nama` varchar(100) NOT NULL,
  `divisi_deskripsi` text NOT NULL,
  `deputi_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `divisi_nama`, `divisi_deskripsi`, `deputi_id`, `created_at`, `edited_at`, `deleted_at`) VALUES
(24, 'SEKRETARIS BADAN', '', NULL, '2023-03-08 04:59:32', NULL, NULL),
(25, 'SPI ATAU INTERNAL AUDIT', '', NULL, '2023-03-08 04:59:50', '2023-03-08 12:00:16', NULL),
(26, 'PERENCANAAN DAN PEROLEHAN', '', 1, '2023-03-08 05:00:45', NULL, NULL),
(27, 'PENGELOLAAN TANAH', '', 2, '2023-03-08 05:01:07', NULL, NULL),
(28, 'PEMANFAATAN TANAH DAN PENGEMBANGAN USAHA', '', 3, '2023-03-08 05:01:25', NULL, NULL),
(29, 'KEUANGAN DAN AKUNTANSI', '', 4, '2023-03-08 05:02:44', NULL, NULL),
(30, 'UMUM DAN ADMINISTRASI', '', 4, '2023-03-08 05:03:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi_bagian`
--

CREATE TABLE `divisi_bagian` (
  `divisi_bagian_id` int(11) NOT NULL,
  `divisi_bagian_nama` varchar(100) NOT NULL,
  `divisi_bagian_deskripsi` text NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi_bagian`
--

INSERT INTO `divisi_bagian` (`divisi_bagian_id`, `divisi_bagian_nama`, `divisi_bagian_deskripsi`, `divisi_id`, `created_at`, `edited_at`, `deleted_at`) VALUES
(42, 'HUKUM', '', 24, '2023-03-08 06:42:09', NULL, NULL),
(43, 'KOMUNIKASI DAN SEKRETARIAT', '', 24, '2023-03-08 06:42:40', NULL, NULL),
(44, 'SUMBER DAYA MANUSIA', '', 24, '2023-03-08 06:43:08', NULL, NULL),
(45, 'SPI ATAU INTERNAL AUDIT', '', 25, '2023-03-08 06:43:52', NULL, NULL),
(46, 'PERENCANAAN STRATEGIS BIDANG PEROLEHAN, PENGADAAN DAN PENDISTRIBUSIAN TANAH', '', 26, '2023-03-08 06:44:28', NULL, NULL),
(47, 'PEROLEHAN, PENGADAAN DAN PENDISTRIBUSIAN TANAH 1', '', 26, '2023-03-08 06:45:18', NULL, NULL),
(48, 'PEROLEHAN, PENGADAAN DAN PENDISTRIBUSIAN TANAH 2', '', 26, '2023-03-08 06:45:57', NULL, NULL),
(49, 'MANAJEMEN RISIKO', '', 26, '2023-03-08 06:46:23', NULL, NULL),
(50, 'PERENCANAAN TEKNIS BIDANG PENGELOLAAN', '', 27, '2023-03-08 06:47:18', NULL, NULL),
(51, 'PENGEMBANGAN, PEMEIHARAAN, PENGAMANAN DAN PENGENDALIAN TANAH', '', 27, '2023-03-08 06:47:43', NULL, NULL),
(52, 'PEMANFAATAN TANAH', '', 28, '2023-03-08 06:49:18', NULL, NULL),
(53, 'KERJA SAMA DAN PENGEMBANGAN USAHA', '', 28, '2023-03-08 06:49:38', NULL, NULL),
(54, 'AKUNTANSI', '', 29, '2023-03-08 06:50:01', NULL, NULL),
(55, 'OPERASIONAL DAN PENDANAAN', '', 29, '2023-03-08 06:50:29', NULL, NULL),
(56, 'TEKNOLOGI INFORMASI', '', 30, '2023-03-08 06:51:15', NULL, NULL),
(57, 'UMUM DAN PENGADAAN', '', 30, '2023-03-08 06:51:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(100) NOT NULL,
  `jabatan_deskripsi` text NOT NULL,
  `jabatan_level` int(11) DEFAULT NULL,
  `jabatan_under` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `pegawai_nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`, `jabatan_deskripsi`, `jabatan_level`, `jabatan_under`, `pegawai_id`, `pegawai_nama`, `created_at`, `edited_at`, `deleted_at`) VALUES
(31, 'KEPALA BADAN', '', 1, 0, 11, 'Parman Nataatmaja', '2022-11-07 06:29:31', NULL, NULL),
(35, 'DEPUTI BIDANG PERENCANAAN STRATEGIS DAN PENGADAAN TANAH', '', 2, 31, 13, 'Ir. Perdananto Aribowo', '2022-11-07 06:31:24', NULL, NULL),
(36, 'DEPUTI BIDANG PENGEMBANGAN USAHA DAN KEUANGAN', '', 2, 31, 12, 'Hakiki Sudrajat', '2022-11-07 06:32:12', NULL, NULL),
(37, 'SEKRETARIS BADAN', '', 2, 31, NULL, NULL, '2022-11-07 06:36:09', NULL, NULL),
(38, 'KEPALA SPI/INTERNAL AUDIT', '', 2, 31, NULL, NULL, '2022-11-07 06:36:42', NULL, NULL),
(39, 'KEPALA DIVISI PERENCANAAN STRATEGIS', '', 3, 35, 28, 'Jerzi Budiarto', '2022-11-07 06:37:16', NULL, NULL),
(40, 'KEPALA DIVISI PERENCANAAN TEKNIS', '', 3, 35, NULL, NULL, '2022-11-07 06:37:34', NULL, NULL),
(41, 'KEPALA DIVISI PEROLEHAN DAN PENGADAAN TANAH', '', 3, 35, NULL, NULL, '2022-11-07 06:38:37', NULL, NULL),
(42, 'KEPALA DIVISI PENGELOLAAN TANAH', '', 3, 35, NULL, NULL, '2022-11-07 06:38:55', NULL, NULL),
(43, 'KEPALA DIVISI PEMANFAATAN TANAH NON/SEMI KOMERSIAL', '', 3, 36, NULL, NULL, '2022-11-07 06:39:25', NULL, NULL),
(44, 'KEPALA DIVISI PENGEMBANGAN USAHA KOMERSIAL', '', 3, 36, NULL, NULL, '2022-11-07 06:39:55', NULL, NULL),
(45, 'KEPALA DIVISI KEUANGAN DAN AKUNTANSI', '', 3, 36, NULL, NULL, '2022-11-07 06:40:14', NULL, NULL),
(46, 'KEPALA DIVISI INFORMASI TEKNOLOGI DAN OPERASIONAL', '', 3, 36, NULL, NULL, '2022-11-07 06:41:01', NULL, NULL),
(47, 'KEPALA BAGIAN HUKUM DAN KERJA SAMA', '', 3, 37, NULL, NULL, '2022-11-07 06:45:56', NULL, NULL),
(48, 'KEPALA BAGIAN HUBUNGAN MASYARAKAT', '', 3, 37, NULL, NULL, '2022-11-07 06:46:16', NULL, NULL),
(49, 'KEPALA BAGIAN SUMBER DAYA MANUSIA DAN ADMINSTRASI', '', 3, 37, NULL, NULL, '2022-11-07 06:46:35', NULL, NULL),
(50, 'KEPALA BAGIAN PENGADAAN', '', 3, 37, NULL, NULL, '2022-11-07 06:46:55', NULL, NULL),
(51, 'KEPALA BAGIAN PERENCANAAN INTERNAL', '', 3, 37, NULL, NULL, '2022-11-07 06:47:16', NULL, NULL),
(52, 'KEPALA BAGIAN SPI/ INTERNAL AUDIT', '', 3, 38, NULL, NULL, '2022-11-07 06:47:50', NULL, NULL),
(53, 'KEPALA BAGIAN PENYUSUNAN RENCANA INDUK DAN RENCANA KERJA BANK TANAH', '', 4, 39, NULL, NULL, '2022-11-07 06:48:20', NULL, NULL),
(54, 'KEPALA BAGIAN MANAJEMEN RISIKO', '', 4, 39, NULL, NULL, '2022-11-07 06:48:55', NULL, NULL),
(55, 'KEPALA BAGIAN PERENCANAAN TEKNIS BIDANG PEROLEHAN, PENGADAAN DAN PENGELOLAAN TANAH', '', 4, 40, NULL, NULL, '2022-11-07 06:53:19', NULL, NULL),
(56, 'KEPALA BAGIAN PERENCANAAN TEKNIS BIDANG PEMANFAATAN DAN PENDIST', '', 4, 40, NULL, NULL, '2022-11-07 06:53:47', NULL, NULL),
(57, 'KEPALA BAGIAN PERENCANAAN PETA TEMATIK TANAH DAN KAWASAN', '', 4, 40, NULL, NULL, '2022-11-07 06:54:10', NULL, NULL),
(58, 'KEPALA BAGIAN PEROLEHAN TANAH DAN PENGADAAN TANAH', '', 4, 41, NULL, NULL, '2022-11-07 06:54:53', NULL, NULL),
(59, 'KEPALA BAGIAN PENGEMBANGAN TANAH', '', 4, 42, NULL, NULL, '2022-11-07 06:55:45', NULL, NULL),
(60, 'KEPALA BAGIAN PEMELIHARAAN DAN PENGAMANAN TANAH', '', 4, 42, NULL, NULL, '2022-11-07 06:56:55', NULL, NULL),
(61, 'KEPALA BAGIAN PEMANFAATAN TANAH', '', 4, 43, NULL, NULL, '2022-11-07 06:57:23', NULL, NULL),
(62, 'KEPALA BAGIAN RISET DAN PENYUSUNAN TARIF PEMANFAATAN', '', 4, 44, NULL, NULL, '2022-11-07 06:57:51', NULL, NULL),
(63, 'KEPALA BAGIAN KERJA SAMA DAN PENGEMBANGAN USAHA', '', 4, 44, NULL, NULL, '2022-11-07 06:58:27', NULL, NULL),
(64, 'KEPALA BAGIAN KEUANGAN DAN AKUNTANSI', '', 4, 45, NULL, NULL, '2022-11-07 06:58:56', NULL, NULL),
(65, 'KEPALA BAGIAN OPERASIONAL', '', 4, 45, NULL, NULL, '2022-11-07 07:00:58', NULL, NULL),
(66, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:01:56', NULL, NULL),
(67, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:02:15', NULL, NULL),
(68, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:02:26', NULL, NULL),
(69, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:03:23', NULL, NULL),
(70, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:12', NULL, NULL),
(71, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:25', NULL, NULL),
(72, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:35', NULL, NULL),
(73, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:55', NULL, NULL),
(74, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:05:03', NULL, NULL),
(75, 'STAF', '', 4, 50, NULL, NULL, '2022-11-07 07:05:22', NULL, NULL),
(76, 'STAF', '', 5, 53, NULL, NULL, '2022-11-07 07:05:56', NULL, NULL),
(77, 'STAF', '', 5, 55, NULL, NULL, '2022-11-07 07:06:34', NULL, NULL),
(78, 'STAF', '', 5, 55, NULL, NULL, '2022-11-07 07:06:53', NULL, NULL),
(79, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:17', NULL, NULL),
(80, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:39', NULL, NULL),
(81, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:55', NULL, NULL),
(82, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:08:16', NULL, NULL),
(83, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:08:40', NULL, NULL),
(84, 'STAF', '', 5, 59, NULL, NULL, '2022-11-07 07:09:10', NULL, NULL),
(85, 'STAF', '', 5, 59, NULL, NULL, '2022-11-07 07:09:25', NULL, NULL),
(86, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:03', NULL, NULL),
(87, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:12', NULL, NULL),
(88, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:21', NULL, NULL),
(89, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:33', NULL, NULL),
(90, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:54', NULL, NULL),
(91, 'KEPALA BAGIAN PENGEMBANGAN TEKNOLOGI INFORMASI', '', 4, 46, NULL, NULL, '2022-11-07 07:12:37', NULL, NULL),
(92, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:12:53', NULL, NULL),
(93, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:13:00', NULL, NULL),
(94, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:13:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(255) NOT NULL,
  `jabatan_level` int(11) NOT NULL,
  `jabatan_desc` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`jabatan_id`, `jabatan_nama`, `jabatan_level`, `jabatan_desc`, `created_at`, `deleted_at`, `edited_at`) VALUES
(1, 'Kepala Badan', 1, NULL, '2023-01-04 10:36:38', NULL, NULL),
(2, 'Deputi', 2, NULL, '2023-01-04 10:36:58', NULL, NULL),
(3, 'Kepala Divisi', 3, NULL, '2023-01-04 10:37:12', NULL, NULL),
(4, 'Kepala Bagian', 4, NULL, '2023-01-04 10:37:32', NULL, NULL),
(6, 'Staf', 5, NULL, '2023-01-04 13:55:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pegawai_level`
--

CREATE TABLE `master_pegawai_level` (
  `level_id` int(11) NOT NULL,
  `level_nama` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `level_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pegawai_level`
--

INSERT INTO `master_pegawai_level` (`level_id`, `level_nama`, `level`, `level_desc`) VALUES
(1, 'Manager', 1, ''),
(2, 'Assistant Manager', 2, ''),
(3, 'Senior Staff', 3, ''),
(4, 'Junior Staff', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `master_pegawai_status`
--

CREATE TABLE `master_pegawai_status` (
  `status_pegawai_id` int(11) NOT NULL,
  `status_nama` varchar(100) NOT NULL,
  `status_deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pegawai_status`
--

INSERT INTO `master_pegawai_status` (`status_pegawai_id`, `status_nama`, `status_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'PEGAWAI TETAP', 'PKWTT', '2022-11-03 07:04:03', NULL, NULL),
(3, 'PEGAWAI KONTRAK', 'PKWT', '2022-11-03 07:04:13', NULL, NULL),
(5, 'PEGAWAI OUTSOURCE', '', '2023-03-06 04:10:32', NULL, NULL),
(6, 'PEGAWAI MAGANG', '', '2023-03-06 04:10:44', NULL, NULL),
(7, 'NON PEGAWAI', 'Penasihat/Tenaga Ahli', '2023-03-07 04:05:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pendidikan`
--

CREATE TABLE `master_pendidikan` (
  `pendidikan_id` int(11) NOT NULL,
  `pendidikan_nama` varchar(100) NOT NULL,
  `pendidikan_deskripsi` varchar(1000) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pendidikan`
--

INSERT INTO `master_pendidikan` (`pendidikan_id`, `pendidikan_nama`, `pendidikan_deskripsi`, `urutan`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'SMA', '', 2, '2022-11-03 07:06:07', NULL, NULL),
(3, 'SMK', '', 3, '2022-11-03 07:06:20', NULL, NULL),
(4, 'Diploma 1', '', 4, '2022-11-03 07:06:39', NULL, NULL),
(5, 'Diploma 2', '', 5, '2022-11-03 07:06:45', NULL, NULL),
(6, 'Diploma 3', '', 6, '2022-11-03 07:06:52', NULL, NULL),
(7, 'Diploma 4', '', 7, '2022-11-03 07:07:00', NULL, NULL),
(8, 'Strata 1', '', 8, '2022-11-03 07:07:08', NULL, NULL),
(9, 'Strata 2', '', 9, '2022-11-03 07:07:17', NULL, NULL),
(10, 'Strata 3', '', 10, '2022-11-03 07:07:43', NULL, NULL),
(11, 'Lainnya', '', 99, '2022-11-20 05:33:02', NULL, NULL),
(12, 'SMP', '', 1, '2022-11-20 05:47:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(11) NOT NULL,
  `pegawai_nama` varchar(100) NOT NULL,
  `pegawai_nik` varchar(100) DEFAULT NULL,
  `pegawai_tempat_lahir` varchar(255) DEFAULT NULL,
  `pegawai_tgl_lahir` datetime NOT NULL,
  `pegawai_gender` char(2) NOT NULL,
  `pendidikan_id` int(11) DEFAULT NULL,
  `pegawai_agama` varchar(100) DEFAULT NULL,
  `pegawai_kewarganegaraan` varchar(100) DEFAULT NULL,
  `pegawai_pernikahan` varchar(100) DEFAULT NULL,
  `pegawai_alamat` varchar(500) NOT NULL,
  `pegawai_kota` varchar(100) DEFAULT NULL,
  `pegawai_provinsi` varchar(100) DEFAULT NULL,
  `pegawai_pos` varchar(100) DEFAULT NULL,
  `pegawai_telepon` varchar(100) DEFAULT NULL,
  `pegawai_email_pribadi` varchar(100) DEFAULT NULL,
  `pegawai_nip` varchar(100) DEFAULT NULL,
  `pegawai_tgl_gabung` datetime NOT NULL,
  `pegawai_tgl_keluar` datetime DEFAULT NULL,
  `pegawai_email_kantor` varchar(255) DEFAULT NULL,
  `pegawai_npwp` varchar(100) DEFAULT NULL,
  `pegawai_foto` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `pegawai_nama`, `pegawai_nik`, `pegawai_tempat_lahir`, `pegawai_tgl_lahir`, `pegawai_gender`, `pendidikan_id`, `pegawai_agama`, `pegawai_kewarganegaraan`, `pegawai_pernikahan`, `pegawai_alamat`, `pegawai_kota`, `pegawai_provinsi`, `pegawai_pos`, `pegawai_telepon`, `pegawai_email_pribadi`, `pegawai_nip`, `pegawai_tgl_gabung`, `pegawai_tgl_keluar`, `pegawai_email_kantor`, `pegawai_npwp`, `pegawai_foto`, `created_at`, `edited_at`, `deleted_at`, `created_by`, `edited_by`, `deleted_by`, `is_active`) VALUES
(114, 'Charly Maruly', '1231', 'Medan', '1988-12-13 00:00:00', 'L', 8, 'Kristen', 'Warga Negara Indonesia', 'Belum Menikah', 'Jl. Jalan 3', 'Jakarta Timur', 'DKI Jakarta', '17122', '08123456789', 'charly@gmail.com', '2222', '2022-11-09 00:00:00', NULL, 'charly@banktanah.id', '9876123456', 'http://localhost/mawas/gambar/pegawai/403195a449e494d7c720ff18184edc7a.png', '2023-05-08 15:19:06', '2023-05-10 14:06:44', '2023-05-10 14:07:02', NULL, 'Dummy Admin', 'Dummy Admin', 0),
(115, 'Dody Mulyady', '123', 'Bandung', '1989-11-15 00:00:00', 'L', 8, 'Islam', 'Warga Negara Indonesia', 'Menikah', 'Jl. Jalan 4', 'Bekasi', 'Jawa Barat', '17255', '081236543', 'dody@gmail.com', '2222123', '2023-05-08 00:00:00', NULL, 'dody@banktanah.ic', '11211', 'http://localhost/mawas/gambar/pegawai/9157df423c8443d05994c44cef28d020.png', '2023-05-08 15:39:34', NULL, '2023-05-10 13:43:29', NULL, NULL, 'Dummy Admin', 0),
(116, 'Elody Suwandy', '131231321333', 'Surabaya', '1994-11-11 00:00:00', 'P', 8, 'Konghucu', 'Warga Negara Indonesia', 'Belum Menikah', 'Jl. Jalan 5', 'Jakarta Selatan', 'DKI Jakarta', '17222', '08123454321', 'elody@gmail.com', '2222111', '2023-05-08 00:00:00', NULL, 'elody@banktanah.id', '123111', 'http://localhost/mawas/gambar/pegawai/010391d646a8436432865c7474935d58.png', '2023-05-08 15:41:48', NULL, '2023-05-10 13:43:25', NULL, NULL, 'Dummy Admin', 0),
(117, 'Foldy Reynaldy', '11223344', 'Jakarta', '1990-10-10 00:00:00', 'L', 8, 'Islam', 'Warga Negara Indonesia', 'Belum Menikah', 'Jl. Jalan 6', 'Tangerang Selatan', 'Banten', '17666', '081512346789', 'foldy@gmail.com', '987654666', '2023-05-09 00:00:00', NULL, 'foldy@banktanah.id', '123321', 'http://localhost/mawas/gambar/pegawai/eaa2f13420550e9ab7966717144f4778.png', '2023-05-09 09:21:05', NULL, '2023-05-10 13:43:21', 'Administrator', NULL, 'Dummy Admin', 0),
(118, 'Ghouly Sinarly', '12311111', 'Magelang', '1995-05-12 00:00:00', 'L', 8, 'Islam', 'Warga Negara Indonesia', 'Belum Menikah', 'Jl. Jalan 8', 'Bekasi', 'Jawa Barat', '17566', '08156789432', 'ghouly@gmail.com', '2222112', '2023-05-09 00:00:00', NULL, 'ghouly@banktanah.id', '112113', 'http://localhost/mawas/gambar/pegawai/8ea7020e0db71541c10ad26449ec2e17.png', '2023-05-09 09:23:59', NULL, '2023-05-10 13:43:16', 'Administrator', NULL, 'Dummy Admin', 0),
(119, 'Holly Molly', '1231231', 'Semarang', '1994-12-11 00:00:00', 'L', 8, 'Kristen', 'Warga Negara Indonesia', 'Belum Menikah', 'Jl. Jalan 9', 'Depok', 'Jawa Barat', '17123', '08123456789', 'holly@gmail.com', '111222444', '2023-05-09 00:00:00', NULL, 'holly@banktanah.id', '112113114', 'http://localhost/mawas/gambar/pegawai/3c426e84317bf1fa563da61370037a84.png', '2023-05-09 09:26:56', NULL, '2023-05-10 13:43:10', 'Administrator', NULL, 'Dummy Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_karir`
--

CREATE TABLE `pegawai_karir` (
  `karir_id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `status_pegawai_id` int(11) DEFAULT NULL,
  `posisi_pegawai` varchar(255) DEFAULT NULL,
  `deputi_id` int(11) DEFAULT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `divisi_bagian_id` int(11) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `pegawai_atasan_langsung` int(11) DEFAULT NULL,
  `pegawai_atasan_atasan` int(11) DEFAULT NULL,
  `penempatan` varchar(500) DEFAULT NULL,
  `perolehan_id` int(11) DEFAULT NULL,
  `tgl_awal` datetime DEFAULT NULL,
  `tgl_akhir` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_karir_riwayat`
--

CREATE TABLE `pegawai_karir_riwayat` (
  `riwayat_id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `karir_id` int(11) NOT NULL,
  `pegawai_nama` varchar(255) DEFAULT NULL,
  `pegawai_status` varchar(255) DEFAULT NULL,
  `pegawai_posisi` varchar(255) DEFAULT NULL,
  `pegawai_deputi` varchar(255) DEFAULT NULL,
  `pegawai_divisi` varchar(255) DEFAULT NULL,
  `pegawai_divisi_bagian` varchar(255) DEFAULT NULL,
  `pegawai_atasan_langsung` varchar(255) DEFAULT NULL,
  `pegawai_atasan_atasan` varchar(255) DEFAULT NULL,
  `pegawai_jabatan` varchar(255) DEFAULT NULL,
  `pegawai_level` varchar(255) DEFAULT NULL,
  `tgl_awal` datetime DEFAULT NULL,
  `tgl_akhir` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `penempatan` varchar(500) DEFAULT NULL,
  `perolehan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `user_nama` varchar(100) DEFAULT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `hrm_level` varchar(20) DEFAULT NULL,
  `is_dummy` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pegawai_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `foto_path`, `hrm_level`, `is_dummy`) VALUES
(1, NULL, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin_avatar.jpg', NULL, 'Superadmin', 1),
(37, NULL, 'Dummy Admin', 'dummy.admin@banktanah.id', 'ddcf1a05fc21c90c386c63ae7d0d538c', '4956ca5cdb6827a6611f6d5468223bb2.png', 'http://localhost/mawas/gambar/user/4956ca5cdb6827a6611f6d5468223bb2.png', 'Superadmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_nama` varchar(100) NOT NULL,
  `role_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_nama`, `role_desc`) VALUES
(2, 'Admin', NULL),
(3, 'User', NULL),
(6, 'Viewer', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`apps_id`);

--
-- Indexes for table `deputi`
--
ALTER TABLE `deputi`
  ADD PRIMARY KEY (`deputi_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`divisi_id`),
  ADD KEY `deputi_id` (`deputi_id`);

--
-- Indexes for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  ADD PRIMARY KEY (`divisi_bagian_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `master_pegawai_level`
--
ALTER TABLE `master_pegawai_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `master_pegawai_status`
--
ALTER TABLE `master_pegawai_status`
  ADD PRIMARY KEY (`status_pegawai_id`);

--
-- Indexes for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  ADD PRIMARY KEY (`pendidikan_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`),
  ADD KEY `pendidikan_id` (`pendidikan_id`);

--
-- Indexes for table `pegawai_karir`
--
ALTER TABLE `pegawai_karir`
  ADD PRIMARY KEY (`karir_id`),
  ADD KEY `divisi_bagian_id` (`divisi_bagian_id`),
  ADD KEY `divisi_id` (`divisi_id`),
  ADD KEY `pegawai_karir_ibfk_3` (`jabatan_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `status_pegawai_id` (`status_pegawai_id`),
  ADD KEY `pegawai_atasan_langsung` (`pegawai_atasan_langsung`),
  ADD KEY `pegawai_atasan_atasan` (`pegawai_atasan_atasan`),
  ADD KEY `deputi_id` (`deputi_id`);

--
-- Indexes for table `pegawai_karir_riwayat`
--
ALTER TABLE `pegawai_karir_riwayat`
  ADD PRIMARY KEY (`riwayat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `apps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deputi`
--
ALTER TABLE `deputi`
  MODIFY `deputi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `divisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  MODIFY `divisi_bagian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_pegawai_level`
--
ALTER TABLE `master_pegawai_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pegawai_status`
--
ALTER TABLE `master_pegawai_status`
  MODIFY `status_pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  MODIFY `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `pegawai_karir`
--
ALTER TABLE `pegawai_karir`
  MODIFY `karir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `pegawai_karir_riwayat`
--
ALTER TABLE `pegawai_karir_riwayat`
  MODIFY `riwayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `divisi_ibfk_1` FOREIGN KEY (`deputi_id`) REFERENCES `deputi` (`deputi_id`);

--
-- Constraints for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  ADD CONSTRAINT `divisi_bagian_ibfk_1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`divisi_id`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`pendidikan_id`) REFERENCES `master_pendidikan` (`pendidikan_id`);

--
-- Constraints for table `pegawai_karir`
--
ALTER TABLE `pegawai_karir`
  ADD CONSTRAINT `pegawai_karir_ibfk_1` FOREIGN KEY (`divisi_bagian_id`) REFERENCES `divisi_bagian` (`divisi_bagian_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_2` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`divisi_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_3` FOREIGN KEY (`jabatan_id`) REFERENCES `master_jabatan` (`jabatan_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_4` FOREIGN KEY (`level_id`) REFERENCES `master_pegawai_level` (`level_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_5` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`pegawai_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_6` FOREIGN KEY (`status_pegawai_id`) REFERENCES `master_pegawai_status` (`status_pegawai_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_7` FOREIGN KEY (`pegawai_atasan_langsung`) REFERENCES `pegawai` (`pegawai_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_8` FOREIGN KEY (`pegawai_atasan_atasan`) REFERENCES `pegawai` (`pegawai_id`),
  ADD CONSTRAINT `pegawai_karir_ibfk_9` FOREIGN KEY (`deputi_id`) REFERENCES `deputi` (`deputi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
