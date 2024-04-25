-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 03:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbeasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mahasiswa`, `alamat`, `telp`) VALUES
('362201002', 'Andhika Rudiansyah', 'Cimahi', '08564865848'),
('362201010', 'Ihsan pratama putra', 'Cianjur, Bandung', '085513184864'),
('362201035', 'Andre Pratama', 'rancaekek', '085222625070');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `iddaftar` int(11) NOT NULL,
  `tgldaftar` date DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `pendapatan_ortu` int(11) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  `jml_saudara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`iddaftar`, `tgldaftar`, `tahun`, `nim`, `pendapatan_ortu`, `ipk`, `jml_saudara`) VALUES
(3, '2024-04-02', '2022', '362201010', 3000000, 3.55, 3),
(4, '2024-04-02', '2022', '362201002', 2000000, 3.00, 2),
(5, '2024-04-02', '2022', '362201035', 1500000, 4.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `perangkingan`
--

CREATE TABLE `perangkingan` (
  `idperangkingan` int(11) NOT NULL,
  `iddaftar` int(11) DEFAULT NULL,
  `n_pendapatan` decimal(4,3) DEFAULT NULL,
  `n_ipk` decimal(4,3) DEFAULT NULL,
  `n_saudara` decimal(4,3) DEFAULT NULL,
  `preferensi` decimal(4,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `perangkingan`
--

INSERT INTO `perangkingan` (`idperangkingan`, `iddaftar`, `n_pendapatan`, `n_ipk`, `n_saudara`, `preferensi`) VALUES
(5, 3, 0.500, 1.000, 1.000, 0.750),
(6, 4, 0.750, 1.000, 0.667, 0.808),
(7, 5, 1.000, 1.000, 1.000, 1.000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `level`) VALUES
(6, 'razerfear', '0192023a7bbd73250516f069df18b500', 'SuperAdmin'),
(7, 'andre', 'dd573120e473c889140e34e817895495', 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vperangkingan`
-- (See below for the actual view)
--
CREATE TABLE `vperangkingan` (
`idperangkingan` int(11)
,`iddaftar` int(11)
,`tgldaftar` date
,`tahun` varchar(4)
,`nim` varchar(10)
,`nama_mahasiswa` varchar(100)
,`n_pendapatan` decimal(4,3)
,`n_ipk` decimal(4,3)
,`n_saudara` decimal(4,3)
,`preferensi` decimal(4,3)
);

-- --------------------------------------------------------

--
-- Structure for view `vperangkingan`
--
DROP TABLE IF EXISTS `vperangkingan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vperangkingan`  AS SELECT `perangkingan`.`idperangkingan` AS `idperangkingan`, `perangkingan`.`iddaftar` AS `iddaftar`, `pendaftaran`.`tgldaftar` AS `tgldaftar`, `pendaftaran`.`tahun` AS `tahun`, `pendaftaran`.`nim` AS `nim`, `mahasiswa`.`nama_mahasiswa` AS `nama_mahasiswa`, `perangkingan`.`n_pendapatan` AS `n_pendapatan`, `perangkingan`.`n_ipk` AS `n_ipk`, `perangkingan`.`n_saudara` AS `n_saudara`, `perangkingan`.`preferensi` AS `preferensi` FROM ((`pendaftaran` join `perangkingan` on(`pendaftaran`.`iddaftar` = `perangkingan`.`iddaftar`)) join `mahasiswa` on(`mahasiswa`.`nim` = `pendaftaran`.`nim`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`) USING BTREE;

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`iddaftar`) USING BTREE;

--
-- Indexes for table `perangkingan`
--
ALTER TABLE `perangkingan`
  ADD PRIMARY KEY (`idperangkingan`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `iddaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perangkingan`
--
ALTER TABLE `perangkingan`
  MODIFY `idperangkingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
