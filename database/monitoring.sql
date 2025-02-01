-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2025 at 10:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `nama_file` varchar(250) NOT NULL,
  `upload_spm` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `isi_spm`
--

CREATE TABLE `isi_spm` (
  `id_isi_spm` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `kode_rekening_beban` varchar(250) NOT NULL,
  `uraian_beban` varchar(250) NOT NULL,
  `nilai_beban` int NOT NULL,
  `uraian_potongan` varchar(250) NOT NULL,
  `jumlah_potongan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `isi_spm`
--

INSERT INTO `isi_spm` (`id_isi_spm`, `id_registrasi`, `kode_rekening_beban`, `uraian_beban`, `nilai_beban`, `uraian_potongan`, `jumlah_potongan`) VALUES
(4, 1, '223344', 'contoh1', 12123331, 'contoh11', 1223332),
(5, 4, '223344', 'contoh1', 12123331, 'contoh11', 343434),
(6, 6, '11223344', 'contoh3', 120000, 'contoh33', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `kepala`
--

CREATE TABLE `kepala` (
  `id_kepala` int NOT NULL,
  `nama_kepala` varchar(250) NOT NULL,
  `nip` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kepala`
--

INSERT INTO `kepala` (`id_kepala`, `nama_kepala`, `nip`, `jabatan`) VALUES
(1, 'SYAPIQ HUWAIDA, S.T', '123456789', 'Kepala Bidang');

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int NOT NULL,
  `nomor_registrasi` varchar(250) NOT NULL,
  `skpd` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_pengantar` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cv` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `tanggal_registrasi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_spm` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uraian` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `transfer_ke` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `nomor_registrasi`, `skpd`, `no_pengantar`, `cv`, `nominal`, `tanggal_registrasi`, `nomor_spm`, `uraian`, `keterangan`, `transfer_ke`) VALUES
(1, '0001', 'DINAS PEKERJAAN UMU DAN PENATAAN RUANG', '900.1.3.5/0242-BJjb/DPUPR', 'CV. BETON JAYA MANDIRI', '32000000', '2025-01-19', '63.71/03.0/001640/LS/1.03.0.00.0.00.01.0000/PPR2/12/2025', 'LS', 'Pekerjaan Pembangunan Jalan (Jl. Malkon Temon menuju Alkah Guru Zuhdi) (Tahap I) ; Pembayaran Fisik 100%', 'BANK KALSEL'),
(3, '0002', 'Dinas Pariwisata', '900.1.3.5/0242-BJjb/DP', 'CV. JAYA 1', '32', '2025-01-19', '63.71/03.0/001234/LS/1.03.0.00.0.00.01.0000/PPR2/12/2025', 'LS', 'beli alat', 'BANK KALSEL'),
(4, '0003', 'DINAS KESEHATAN', '900.1.3.5/0242-BJjb/DK', 'CV. JAYA 2', '32', '19/01/2025', '63.71/03.0/001234/GU/1.03.0.00.0.00.01.0000/PPR2/12/2025', 'GU', 'beli alat', 'BANK KALSEL'),
(5, 'REG-0001', 'Dinas Lingkungan Hidup', '900.1.3.5/0242-BJjb/DLH', 'CV.ATUTIT', '35', '2025-01-21', '63.71/03.0/001234/LS/1.03.0.00.0.00.01.0000/PPR2/12/2025', 'LS', 'proyek 1', 'Bank Kalsel'),
(6, 'REG-0013', 'Inspektorat', '900.1.3.5/0242-BJjb/ispektrat', 'CV.ATUTIT2', '31000000', '2025-01-22', '63.71/03.0/001234/TU/1.03.0.00.0.00.01.0000/PPR2/12/2025', 'TU', 'Juara 1 Lomba Tricker Vapers', 'Bank Kalsel');

-- --------------------------------------------------------

--
-- Table structure for table `sp2d`
--

CREATE TABLE `sp2d` (
  `id_sp2d` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `tanggal_spm` varchar(250) NOT NULL,
  `dari` varchar(250) NOT NULL,
  `tahun_anggaran` varchar(250) NOT NULL,
  `nomor_sp2d` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sp2d`
--

INSERT INTO `sp2d` (`id_sp2d`, `id_registrasi`, `tanggal_spm`, `dari`, `tahun_anggaran`, `nomor_sp2d`) VALUES
(1, 6, '12122025', '3', '33', '3');

-- --------------------------------------------------------

--
-- Table structure for table `spm_gu`
--

CREATE TABLE `spm_gu` (
  `id_spm_gu` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `jenis_spm` varchar(250) NOT NULL,
  `tanggal_spm` varchar(250) NOT NULL,
  `no_rekening_bank` int NOT NULL,
  `nama_di_rekening_bank` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_bank_cabang` varchar(250) NOT NULL,
  `npwp` int NOT NULL,
  `dasar_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spm_gu`
--

INSERT INTO `spm_gu` (`id_spm_gu`, `id_registrasi`, `jenis_spm`, `tanggal_spm`, `no_rekening_bank`, `nama_di_rekening_bank`, `nama_bank_cabang`, `npwp`, `dasar_pembayaran`) VALUES
(1, 4, 'GU', '2025-01-19', 121212126, 'JUNAIDI2', 'Bank Kalsel', 22222222, '63.71/03.0/003215/1.03.0.00.0.00.01.0000/PPR2/12/2025');

-- --------------------------------------------------------

--
-- Table structure for table `spm_ls`
--

CREATE TABLE `spm_ls` (
  `id_spm_ls` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `jenis_spm` varchar(50) NOT NULL,
  `tanggal_spm` varchar(50) NOT NULL,
  `no_rekening_bank` varchar(50) NOT NULL,
  `nama_di_rekening_bank` varchar(100) NOT NULL,
  `nama_bank_cabang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `npwp` int NOT NULL,
  `dasar_pembayaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spm_ls`
--

INSERT INTO `spm_ls` (`id_spm_ls`, `id_registrasi`, `jenis_spm`, `tanggal_spm`, `no_rekening_bank`, `nama_di_rekening_bank`, `nama_bank_cabang`, `npwp`, `dasar_pembayaran`) VALUES
(1, 1, 'LS', '2025-01-16', '112233445566', 'suripno', 'Bank Kalsel', 123456789, '63.71/03.0/001640/1.03.0.00.0.00.01.0000/PPR2/12/2025');

-- --------------------------------------------------------

--
-- Table structure for table `spm_tu`
--

CREATE TABLE `spm_tu` (
  `id_spm_tu` int NOT NULL,
  `id_registrasi` int NOT NULL,
  `jenis_spm` varchar(250) NOT NULL,
  `tanggal_spm` varchar(250) NOT NULL,
  `no_rekening_bank` int NOT NULL,
  `nama_di_rekening_bank` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_bank_cabang` varchar(250) NOT NULL,
  `npwp` int NOT NULL,
  `dasar_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spm_tu`
--

INSERT INTO `spm_tu` (`id_spm_tu`, `id_registrasi`, `jenis_spm`, `tanggal_spm`, `no_rekening_bank`, `nama_di_rekening_bank`, `nama_bank_cabang`, `npwp`, `dasar_pembayaran`) VALUES
(1, 6, 'TU', '2025-01-23', 20000000, 'JUNAIDI3', 'Bank Kalsel', 333333333, '63.71/03.0/000214/1.03.0.00.0.00.01.0000/PPR2/12/2025');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `level`) VALUES
(1, 'DODY MAULANA NOORJAYA', 'dodyyydody9@gmail.com', 'DODY', '$2y$10$0zF1KAREGc9TTFZHUwzdW.zZiUCoaoVgH2DWJ4cmrefl7MWeDjUba', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int NOT NULL,
  `id_spm_tu` int DEFAULT NULL,
  `id_spm_ls` int DEFAULT NULL,
  `id_spm_gu` int DEFAULT NULL,
  `status_verifikasi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `id_spm_tu`, `id_spm_ls`, `id_spm_gu`, `status_verifikasi`) VALUES
(1, 1, NULL, NULL, 'verifikasi'),
(3, NULL, NULL, 1, 'ditolak'),
(4, NULL, 1, NULL, 'dihapus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `isi_spm`
--
ALTER TABLE `isi_spm`
  ADD PRIMARY KEY (`id_isi_spm`);

--
-- Indexes for table `kepala`
--
ALTER TABLE `kepala`
  ADD PRIMARY KEY (`id_kepala`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indexes for table `sp2d`
--
ALTER TABLE `sp2d`
  ADD PRIMARY KEY (`id_sp2d`);

--
-- Indexes for table `spm_gu`
--
ALTER TABLE `spm_gu`
  ADD PRIMARY KEY (`id_spm_gu`);

--
-- Indexes for table `spm_ls`
--
ALTER TABLE `spm_ls`
  ADD PRIMARY KEY (`id_spm_ls`);

--
-- Indexes for table `spm_tu`
--
ALTER TABLE `spm_tu`
  ADD PRIMARY KEY (`id_spm_tu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `isi_spm`
--
ALTER TABLE `isi_spm`
  MODIFY `id_isi_spm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kepala`
--
ALTER TABLE `kepala`
  MODIFY `id_kepala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sp2d`
--
ALTER TABLE `sp2d`
  MODIFY `id_sp2d` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spm_gu`
--
ALTER TABLE `spm_gu`
  MODIFY `id_spm_gu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spm_ls`
--
ALTER TABLE `spm_ls`
  MODIFY `id_spm_ls` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spm_tu`
--
ALTER TABLE `spm_tu`
  MODIFY `id_spm_tu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
