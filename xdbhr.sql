-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 06:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `divisi_id` int(11) NOT NULL,
  `divisi_nama` varchar(100) NOT NULL,
  `divisi_deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `divisi_nama`, `divisi_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(10, 'PERENCANAAN STRATEGIS', '', '2022-11-07 07:38:24', NULL, NULL),
(11, 'PERENCANAAN TEKNIS', 'tes edit', '2022-11-07 07:38:42', '2022-11-11 09:47:56', NULL),
(12, 'PEROLEHAN DAN PENGADAAN TANAH', '', '2022-11-07 07:39:01', NULL, NULL),
(13, 'PENGELOLAAN TANAH', '', '2022-11-07 07:39:19', NULL, NULL),
(14, 'PEMANFAATAN TANAH NON/SEMI KOMERSIAL', '', '2022-11-07 07:39:36', NULL, NULL),
(15, 'PENGEMBANGAN USAHA KOMERSIAL', '', '2022-11-07 07:39:51', NULL, NULL),
(16, 'KEUANGAN DAN AKUNTANSI', '', '2022-11-07 07:40:15', NULL, NULL),
(17, 'INFORMASI TEKNOLOGI DAN OPERASIONAL', '', '2022-11-07 07:40:31', NULL, NULL),
(18, 'SEKRETARIS BADAN', '', '2022-11-07 07:40:53', NULL, NULL),
(19, 'SPI/INTERNAL AUDIT', '', '2022-11-07 07:41:14', NULL, NULL);

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
(9, 'HUKUM DAN KERJA SAMA', '', 18, '2022-11-07 07:42:20', NULL, NULL),
(10, 'HUBUNGAN MASYARAKAT', '', 18, '2022-11-07 07:43:08', NULL, NULL),
(11, 'SUMBER DAYA MANUSIA DAN ADMINSTRASI', '', 18, '2022-11-07 07:43:34', NULL, NULL),
(12, 'PENGADAAN', '', 18, '2022-11-07 07:44:15', NULL, NULL),
(19, ' SPI/ INTERNAL AUDIT', '', 18, '2022-11-07 07:45:39', NULL, NULL),
(20, 'PENYUSUNAN RENCANA INDUK DAN RENCANA KERJA BANK TANAH', '', 10, '2022-11-07 07:52:33', NULL, NULL),
(21, 'MANAJEMEN RISIKO', '', 10, '2022-11-07 07:56:31', NULL, NULL),
(22, 'PERENCANAAN TEKNIS BIDANG PEROLEHAN, PENGADAAN DAN PENGELOLAAN TANAH', '', 11, '2022-11-07 07:57:07', NULL, NULL),
(23, 'PERENCANAAN TEKNIS BIDANG PEMANFAATAN DAN PENDISTRIBUSIAN TANAH', '', 11, '2022-11-07 07:57:36', NULL, NULL),
(24, 'PERENCANAAN PETA TEMATIK TANAH DAN KAWASAN', '', 11, '2022-11-07 07:57:59', NULL, NULL),
(25, 'PEROLEHAN TANAH DAN PENGADAAN TANAH', '', 12, '2022-11-07 07:58:27', NULL, NULL),
(26, 'PENGEMBANGAN TANAH', '', 13, '2022-11-07 07:59:04', NULL, NULL),
(27, 'PEMELIHARAAN DAN PENGAMANAN TANAH', '', 13, '2022-11-07 07:59:29', NULL, NULL),
(28, 'PEMANFAATAN TANAH', '', 14, '2022-11-07 07:59:59', NULL, NULL),
(29, 'RISET DAN PENYUSUNAN TARIF PEMANFAATAN', '', 15, '2022-11-07 08:00:30', NULL, NULL),
(30, 'KERJA SAMA DAN PENGEMBANGAN USAHA', '', 15, '2022-11-07 08:00:53', NULL, NULL),
(31, 'KEUANGAN DAN AKUNTANSI', '', 16, '2022-11-07 08:01:19', NULL, NULL),
(32, 'OPERASIONAL', '', 16, '2022-11-07 08:01:45', NULL, NULL),
(33, 'PENGEMBANGAN TEKNOLOGI INFORMASI', '', 17, '2022-11-07 08:02:09', NULL, NULL);

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
(31, 'KEPALA BADAN', '', 1, 0, 3, 'John Doe', '2022-11-07 06:29:31', NULL, NULL),
(35, 'DEPUTI BIDANG PERENCANAAN STRATEGIS DAN PENGADAAN TANAH', '', 2, 31, 4, 'Asep', '2022-11-07 06:31:24', NULL, NULL),
(36, 'DEPUTI BIDANG PENGEMBANGAN USAHA DAN KEUANGAN', '', 2, 31, 5, 'Ujang', '2022-11-07 06:32:12', NULL, NULL),
(37, 'SEKRETARIS BADAN', '', 2, 31, 6, 'Jane Doe', '2022-11-07 06:36:09', NULL, NULL),
(38, 'KEPALA SPI/INTERNAL AUDIT', '', 2, 31, NULL, NULL, '2022-11-07 06:36:42', NULL, NULL),
(39, 'KEPALA DIVISI PERENCANAAN STRATEGIS', '', 3, 35, NULL, NULL, '2022-11-07 06:37:16', NULL, NULL),
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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(3, 'KATEGORI B'),
(4, 'KATEGORI C'),
(5, 'KATEGORI D'),
(8, 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(11) NOT NULL,
  `pegawai_nama` varchar(100) NOT NULL,
  `pegawai_gender` char(2) NOT NULL,
  `pegawai_tgl_lahir` date NOT NULL,
  `pegawai_domisili` varchar(500) NOT NULL,
  `pegawai_divisi` int(11) NOT NULL,
  `pegawai_divisi_bagian` int(11) NOT NULL,
  `pegawai_pendidikan` int(11) NOT NULL,
  `pegawai_jabatan` int(11) DEFAULT NULL,
  `pegawai_status` int(11) NOT NULL,
  `pegawai_foto` varchar(1000) DEFAULT NULL,
  `pegawai_tgl_gabung` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `pegawai_nama`, `pegawai_gender`, `pegawai_tgl_lahir`, `pegawai_domisili`, `pegawai_divisi`, `pegawai_divisi_bagian`, `pegawai_pendidikan`, `pegawai_jabatan`, `pegawai_status`, `pegawai_foto`, `pegawai_tgl_gabung`, `created_at`, `edited_at`, `deleted_at`) VALUES
(3, 'John Doe', 'L', '1970-05-04', 'Jakarta', 19, 19, 10, NULL, 3, NULL, '2021-12-01', '2022-11-07 08:04:23', NULL, NULL),
(4, 'Asep', 'L', '1979-02-06', 'Jakarta', 10, 31, 10, NULL, 3, NULL, '2021-12-01', '2022-11-07 10:04:03', NULL, NULL),
(5, 'Ujang', 'L', '1977-06-06', 'Jakarta', 10, 33, 10, NULL, 3, NULL, '2021-12-01', '2022-11-07 10:05:39', NULL, NULL),
(6, 'Jane Doe', 'P', '1985-10-15', 'Jakarta', 11, 31, 9, NULL, 3, NULL, '2021-12-01', '2022-11-07 10:06:34', NULL, NULL),
(7, 'Ronaldo', 'L', '1988-02-06', 'Jakarta', 18, 21, 8, NULL, 4, NULL, '2022-07-17', '2022-11-08 07:08:17', NULL, NULL),
(8, 'Ronaldowati', 'P', '1993-10-12', 'Jakarta', 13, 32, 9, NULL, 2, NULL, '2022-09-09', '2022-11-08 07:09:08', NULL, NULL),
(10, 'Djajang Nurdjaman', 'L', '1969-03-05', 'Cimahi', 14, 28, 2, NULL, 2, '0bca165d8cf2aa3b9657cd9aea4457a2.png', '2017-10-17', '2022-11-09 08:03:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `pendidikan_id` int(11) NOT NULL,
  `pendidikan_nama` varchar(100) NOT NULL,
  `pendidikan_deskripsi` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`pendidikan_id`, `pendidikan_nama`, `pendidikan_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'SMA', '', '2022-11-03 07:06:07', NULL, NULL),
(3, 'SMK', '', '2022-11-03 07:06:20', NULL, NULL),
(4, 'Diploma 1', '', '2022-11-03 07:06:39', NULL, NULL),
(5, 'Diploma 2', '', '2022-11-03 07:06:45', NULL, NULL),
(6, 'Diploma 3', '', '2022-11-03 07:06:52', NULL, NULL),
(7, 'Diploma 4', '', '2022-11-03 07:07:00', NULL, NULL),
(8, 'Sarjana 1', '', '2022-11-03 07:07:08', NULL, NULL),
(9, 'Sarjana 2', '', '2022-11-03 07:07:17', NULL, NULL),
(10, 'Sarjana 3', '', '2022-11-03 07:07:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_nama` varchar(100) NOT NULL,
  `project_lokasi` varchar(255) NOT NULL,
  `project_periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_nama`, `project_lokasi`, `project_periode`) VALUES
(4, 'pembangunan halte', 'cunda', '2022'),
(5, 'Pembangunan Parkiran DPRK', 'Lhokseumawe', '2022'),
(6, 'Pembangunan Jembatan Gantung', 'Desa Penari', '2022'),
(8, 'pembangunan  jalan halim kusuma', 'Jakarta Barat', '2022'),
(9, 'renovasi balai desa', 'Jakarta', '2022'),
(12, 'Project Test', 'Jakarta', '1 tahun'),
(13, 'tes', 'cunda', '1 tahun');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi`
--

CREATE TABLE `realisasi` (
  `realisasi_id` int(11) NOT NULL,
  `realisasi_project` int(11) NOT NULL,
  `realisasi_kategori` int(11) NOT NULL,
  `realisasi_sub_kategori` int(11) NOT NULL,
  `realisasi_transaksi` int(11) NOT NULL,
  `realisasi_volume` double DEFAULT NULL,
  `realisasi_harga_satuan` double DEFAULT NULL,
  `realisasi_jumlah_harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `realisasi`
--

INSERT INTO `realisasi` (`realisasi_id`, `realisasi_project`, `realisasi_kategori`, `realisasi_sub_kategori`, `realisasi_transaksi`, `realisasi_volume`, `realisasi_harga_satuan`, `realisasi_jumlah_harga`) VALUES
(4, 13, 4, 10, 4, 120, 10, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `status_pegawai_id` int(11) NOT NULL,
  `status_nama` varchar(100) NOT NULL,
  `status_deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`status_pegawai_id`, `status_nama`, `status_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'Kontrak', '', '2022-11-03 07:04:03', NULL, NULL),
(3, 'Tetap', '', '2022-11-03 07:04:13', NULL, NULL),
(4, 'Magang', '', '2022-11-03 07:04:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `sub_id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`sub_id`, `kategori`, `nama`, `satuan`) VALUES
(10, 4, 'Sub Kategori C1', 'M'),
(11, 4, 'Sub Kategori C2', 'M'),
(12, 4, 'Sub Kategori C3', 'M'),
(13, 5, 'Sub Kategori D1', 'M'),
(14, 5, 'Sub Kategori D2', 'M'),
(15, 5, 'Sub Kategori D4', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_project` int(11) NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_sub_kategori` int(11) DEFAULT NULL,
  `transaksi_rencana_volume` float NOT NULL,
  `transaksi_rencana_harga` float DEFAULT NULL,
  `transaksi_rencana_jumlah` float DEFAULT NULL,
  `transaksi_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_project`, `transaksi_kategori`, `transaksi_sub_kategori`, `transaksi_rencana_volume`, `transaksi_rencana_harga`, `transaksi_rencana_jumlah`, `transaksi_keterangan`) VALUES
(4, 13, 4, 10, 120, 20, 2400, 'Selesai');

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
  `user_level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pegawai_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
(1, NULL, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin_avatar.jpg', 'Admin'),
(6, NULL, 'Maimun zubir xxx', 'Kepala Badan', '870f669e4bbbfa8a6fde65549826d1c4', '', 'Kepala'),
(7, NULL, 'samsul', 'samsul', 'b5146ab5c012993e868d0f7f3ab2c092', '', 'Admin'),
(10, NULL, 'Diki', 'diki', '43b93443937ea642a9a43e77fd5d8f77', NULL, 'Admin'),
(12, NULL, 'Asep', 'asep@banktanah.id', 'dc855efb0dc7476760afaa1b281665f1', NULL, 'Admin'),
(13, NULL, 'Ronaldo', 'ronaldo@banktanah.id', 'c5aa3124b1adad080927ce4d144c6b33', '4ae9b8d7ec3d6a378c43e5bac08d1c95.png', 'Pegawai'),
(14, NULL, 'Ronaldowati', 'ronaldowati@banktanah.id', '1948617260e5ae97b6e6c18ab57dfcf7', 'd9562e04b04ec541b92ee076edf786f9.png', 'Pegawai'),
(15, 3, 'John Doe', 'john@banktanah.id', '527bd5b5d689e2c32ae974c6229ff785', 'd123249fd4f5ede4fbd5c29714bf7f45.png', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`divisi_id`);

--
-- Indexes for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  ADD PRIMARY KEY (`divisi_bagian_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`pendidikan_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`realisasi_id`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`status_pegawai_id`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `divisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  MODIFY `divisi_bagian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `realisasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `status_pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
