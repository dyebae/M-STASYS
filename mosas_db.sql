-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 07:00 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mosas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_03_19_082132_create_tb_kelas_table', 1),
(2, '2019_03_19_082135_create_tb_agama', 1),
(3, '2019_03_19_082139_create_tb_siswa_table', 1),
(4, '2019_03_19_082145_create_tb_guru_table', 1),
(5, '2019_03_19_082211_create_tb_kepsek_table', 1),
(6, '2019_03_19_082218_create_tb_mapel_table', 1),
(7, '2019_03_19_082227_create_tb_kategori_mapel_table', 1),
(8, '2019_03_19_082235_create_tb_semester_table', 1),
(9, '2019_03_19_082242_create_tb_ampu_mapel_table', 1),
(10, '2019_03_19_082252_create_tb_detail_nilai_table', 1),
(11, '2019_03_19_082258_create_tb_nilai_table', 1),
(12, '2019_03_19_135713_create_tb_admin_op_table', 1),
(13, '2019_04_27_113202_create_tb_soal_table', 1),
(14, '2019_05_02_171558_create_tb_nilai_ph_table', 1),
(15, '2019_05_02_171605_create_tb_nilai_pts_table', 1),
(16, '2019_05_02_171609_create_tb_nilai_pas_table', 1),
(17, '2019_06_07_203641_create_tb_hasil_soal_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin_op`
--

CREATE TABLE `tb_admin_op` (
  `username` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` int(10) UNSIGNED DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admin_op`
--

INSERT INTO `tb_admin_op` (`username`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_agama`, `password`, `jenis_kelamin`, `foto`, `created_at`, `updated_at`) VALUES
('Ahmad', 'Dye Bae', NULL, NULL, NULL, 2, '$2y$10$ux4XQYLBWKboQUCgyBWaE.AQz0JhL/F73fNevXjtGUpuqepUetpqK', NULL, NULL, '2019-09-21 00:39:19', '2019-09-21 00:40:04'),
('dye123', 'Mohamad Andi', 'Indramayu', '2019-09-17', 'Indramayu', 2, '$2y$10$sqTQ.XxHeliSCUn08UdUseT3JDyRlAgZcCjJZB2amD.FivrLBaVau', 'Laki-Laki', 'dye123.png', NULL, '2019-09-21 00:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_agama`
--

CREATE TABLE `tb_agama` (
  `id_agama` int(10) UNSIGNED NOT NULL,
  `agama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_agama`
--

INSERT INTO `tb_agama` (`id_agama`, `agama`, `created_at`, `updated_at`) VALUES
(2, 'Islam', '2019-09-21 00:47:49', '2019-09-21 00:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ampu_mapel`
--

CREATE TABLE `tb_ampu_mapel` (
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_semester` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_ampu_mapel`
--

INSERT INTO `tb_ampu_mapel` (`id_ampu`, `nip`, `id_mapel`, `id_kelas`, `id_kategori`, `id_semester`, `created_at`, `updated_at`) VALUES
(1, '123456789123456000', 'MP01', 'K19MIPA1', 'KMP01', 'SM19201', '2019-09-21 04:18:14', '2019-09-21 04:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_nilai`
--

CREATE TABLE `tb_detail_nilai` (
  `id_detail` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_nilai` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nilai` enum('ph','pts','pas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_detail_nilai`
--

INSERT INTO `tb_detail_nilai` (`id_detail`, `jenis_nilai`, `kategori_nilai`, `created_at`, `updated_at`) VALUES
('PAS', 'Penilaian Akhir Semester', 'pas', '2019-09-21 00:56:05', '2019-09-21 00:56:05'),
('PH', 'Penilain Harian', 'ph', '2019-09-21 01:00:46', '2019-09-21 01:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `walikelas` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` int(10) UNSIGNED DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `walikelas`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_agama`, `password`, `jenis_kelamin`, `foto`, `created_at`, `updated_at`) VALUES
('123456789123456000', 'K19MIPA1', 'DYE Bae', 'Indonesia', '0000-00-00', 'Indonesia', 2, '$2y$10$UJNa5w2vBZlvhW9HqSCU/O87koogPXNSpBsh/Co/c5wVZgJohHQta', 'Laki-Laki', NULL, '2019-09-21 04:13:15', '2019-09-21 04:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_soal`
--

CREATE TABLE `tb_hasil_soal` (
  `id_soal` int(10) UNSIGNED NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benar` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salah` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_soal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_mapel`
--

CREATE TABLE `tb_kategori_mapel` (
  `id_kategori` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_mapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori_mapel`
--

INSERT INTO `tb_kategori_mapel` (`id_kategori`, `kategori_mapel`, `created_at`, `updated_at`) VALUES
('KMP01', 'Wajib', '2019-09-21 04:17:56', '2019-09-21 04:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `th_masuk` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rombel` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `th_masuk`, `tingkat`, `jurusan`, `rombel`, `created_at`, `updated_at`) VALUES
('K19MIPA1', '2019', 'X', 'MIPA', 1, '2019-09-21 04:03:38', '2019-09-21 04:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepsek`
--

CREATE TABLE `tb_kepsek` (
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` int(10) UNSIGNED DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kepsek`
--

INSERT INTO `tb_kepsek` (`nip`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_agama`, `password`, `jenis_kelamin`, `foto`, `jabatan`, `created_at`, `updated_at`) VALUES
('123456789123456789', 'Dye Bae', NULL, '2019-09-19', NULL, NULL, '$2y$10$wp4V1fYmHFOx03PBGDEh7OSoRYt9LYTOuvU57wPELsj/H0wfLF46C', 'Laki-Laki', '.png', '', '2019-09-21 00:43:37', '2019-09-21 00:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `nama_mapel`, `created_at`, `updated_at`) VALUES
('MP01', 'Fisika', '2019-09-21 04:16:49', '2019-09-21 04:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(10) UNSIGNED NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `id_detail` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL,
  `date_create` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_update` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_pas`
--

CREATE TABLE `tb_nilai_pas` (
  `id_nilai` int(10) UNSIGNED NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `id_detail` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL,
  `date_create` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_update` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_ph`
--

CREATE TABLE `tb_nilai_ph` (
  `id_nilai` int(10) UNSIGNED NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `id_detail` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL,
  `date_create` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_update` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_pts`
--

CREATE TABLE `tb_nilai_pts` (
  `id_nilai` int(10) UNSIGNED NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `id_detail` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL,
  `date_create` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_update` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(10) UNSIGNED NOT NULL,
  `thn_ajaran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `semester`, `thn_ajaran`, `created_at`, `updated_at`) VALUES
('SM19201', 1, '2019/2020', '2019-09-21 01:01:19', '2019-09-21 01:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ijasah_smp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_un` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` int(10) UNSIGNED DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nisn`, `no_ijasah_smp`, `no_un`, `id_kelas`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_agama`, `password`, `jenis_kelamin`, `foto`, `created_at`, `updated_at`) VALUES
('12345', '1234567890', '1', NULL, 'K19MIPA1', 'DYE', '1', '0000-00-00', '1', 2, '$2y$10$rFtavxHUTb6QfAaXqHwO6./brAyF9UpdDO5knckMcuth/UG.ofde6', 'Laki-Laki', NULL, '2019-09-21 04:04:24', '2019-09-21 04:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(10) UNSIGNED NOT NULL,
  `id_ampu` int(10) UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer` int(10) UNSIGNED NOT NULL,
  `soal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `d` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_create` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `waktu_pengerjaan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin_op`
--
ALTER TABLE `tb_admin_op`
  ADD PRIMARY KEY (`username`),
  ADD KEY `tb_admin_op_id_agama_index` (`id_agama`);

--
-- Indexes for table `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `tb_ampu_mapel`
--
ALTER TABLE `tb_ampu_mapel`
  ADD PRIMARY KEY (`id_ampu`),
  ADD KEY `tb_ampu_mapel_nip_index` (`nip`),
  ADD KEY `tb_ampu_mapel_id_mapel_index` (`id_mapel`),
  ADD KEY `tb_ampu_mapel_id_kelas_index` (`id_kelas`),
  ADD KEY `tb_ampu_mapel_id_kategori_index` (`id_kategori`),
  ADD KEY `tb_ampu_mapel_id_semester_index` (`id_semester`);

--
-- Indexes for table `tb_detail_nilai`
--
ALTER TABLE `tb_detail_nilai`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `tb_guru_id_agama_index` (`id_agama`);

--
-- Indexes for table `tb_hasil_soal`
--
ALTER TABLE `tb_hasil_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `tb_hasil_soal_nis_index` (`nis`);

--
-- Indexes for table `tb_kategori_mapel`
--
ALTER TABLE `tb_kategori_mapel`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_kepsek`
--
ALTER TABLE `tb_kepsek`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `tb_kepsek_id_agama_index` (`id_agama`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `tb_nilai_nis_index` (`nis`),
  ADD KEY `tb_nilai_id_ampu_index` (`id_ampu`),
  ADD KEY `tb_nilai_id_detail_index` (`id_detail`);

--
-- Indexes for table `tb_nilai_pas`
--
ALTER TABLE `tb_nilai_pas`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `tb_nilai_pas_nis_index` (`nis`),
  ADD KEY `tb_nilai_pas_id_ampu_index` (`id_ampu`),
  ADD KEY `tb_nilai_pas_id_detail_index` (`id_detail`);

--
-- Indexes for table `tb_nilai_ph`
--
ALTER TABLE `tb_nilai_ph`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `tb_nilai_ph_nis_index` (`nis`),
  ADD KEY `tb_nilai_ph_id_ampu_index` (`id_ampu`),
  ADD KEY `tb_nilai_ph_id_detail_index` (`id_detail`);

--
-- Indexes for table `tb_nilai_pts`
--
ALTER TABLE `tb_nilai_pts`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `tb_nilai_pts_nis_index` (`nis`),
  ADD KEY `tb_nilai_pts_id_ampu_index` (`id_ampu`),
  ADD KEY `tb_nilai_pts_id_detail_index` (`id_detail`);

--
-- Indexes for table `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `tb_siswa_id_kelas_index` (`id_kelas`),
  ADD KEY `tb_siswa_id_agama_index` (`id_agama`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `tb_soal_id_ampu_index` (`id_ampu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_agama`
--
ALTER TABLE `tb_agama`
  MODIFY `id_agama` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_ampu_mapel`
--
ALTER TABLE `tb_ampu_mapel`
  MODIFY `id_ampu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_hasil_soal`
--
ALTER TABLE `tb_hasil_soal`
  MODIFY `id_soal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_pas`
--
ALTER TABLE `tb_nilai_pas`
  MODIFY `id_nilai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_ph`
--
ALTER TABLE `tb_nilai_ph`
  MODIFY `id_nilai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_pts`
--
ALTER TABLE `tb_nilai_pts`
  MODIFY `id_nilai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin_op`
--
ALTER TABLE `tb_admin_op`
  ADD CONSTRAINT `tb_admin_op_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`);

--
-- Constraints for table `tb_ampu_mapel`
--
ALTER TABLE `tb_ampu_mapel`
  ADD CONSTRAINT `tb_ampu_mapel_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori_mapel` (`id_kategori`),
  ADD CONSTRAINT `tb_ampu_mapel_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`),
  ADD CONSTRAINT `tb_ampu_mapel_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id_mapel`),
  ADD CONSTRAINT `tb_ampu_mapel_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`),
  ADD CONSTRAINT `tb_ampu_mapel_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `tb_guru` (`nip`);

--
-- Constraints for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`);

--
-- Constraints for table `tb_hasil_soal`
--
ALTER TABLE `tb_hasil_soal`
  ADD CONSTRAINT `tb_hasil_soal_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`);

--
-- Constraints for table `tb_kepsek`
--
ALTER TABLE `tb_kepsek`
  ADD CONSTRAINT `tb_kepsek_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`);

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `tb_nilai_id_ampu_foreign` FOREIGN KEY (`id_ampu`) REFERENCES `tb_ampu_mapel` (`id_ampu`),
  ADD CONSTRAINT `tb_nilai_id_detail_foreign` FOREIGN KEY (`id_detail`) REFERENCES `tb_detail_nilai` (`id_detail`),
  ADD CONSTRAINT `tb_nilai_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`);

--
-- Constraints for table `tb_nilai_pas`
--
ALTER TABLE `tb_nilai_pas`
  ADD CONSTRAINT `tb_nilai_pas_id_ampu_foreign` FOREIGN KEY (`id_ampu`) REFERENCES `tb_ampu_mapel` (`id_ampu`),
  ADD CONSTRAINT `tb_nilai_pas_id_detail_foreign` FOREIGN KEY (`id_detail`) REFERENCES `tb_detail_nilai` (`id_detail`),
  ADD CONSTRAINT `tb_nilai_pas_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`);

--
-- Constraints for table `tb_nilai_ph`
--
ALTER TABLE `tb_nilai_ph`
  ADD CONSTRAINT `tb_nilai_ph_id_ampu_foreign` FOREIGN KEY (`id_ampu`) REFERENCES `tb_ampu_mapel` (`id_ampu`),
  ADD CONSTRAINT `tb_nilai_ph_id_detail_foreign` FOREIGN KEY (`id_detail`) REFERENCES `tb_detail_nilai` (`id_detail`),
  ADD CONSTRAINT `tb_nilai_ph_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`);

--
-- Constraints for table `tb_nilai_pts`
--
ALTER TABLE `tb_nilai_pts`
  ADD CONSTRAINT `tb_nilai_pts_id_ampu_foreign` FOREIGN KEY (`id_ampu`) REFERENCES `tb_ampu_mapel` (`id_ampu`),
  ADD CONSTRAINT `tb_nilai_pts_id_detail_foreign` FOREIGN KEY (`id_detail`) REFERENCES `tb_detail_nilai` (`id_detail`),
  ADD CONSTRAINT `tb_nilai_pts_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`);

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`),
  ADD CONSTRAINT `tb_siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_id_ampu_foreign` FOREIGN KEY (`id_ampu`) REFERENCES `tb_ampu_mapel` (`id_ampu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
