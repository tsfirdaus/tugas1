-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220427.b008cca95d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 08:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas1`
--

-- --------------------------------------------------------

--
-- Table structure for table `info_siswa`
--

CREATE TABLE `info_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_siswa`
--

INSERT INTO `info_siswa` (`id`, `nis`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kelas`) VALUES
(63, '102', 'Chairul Iskandar Zulkarnaen', 'Kalimantan barat', '2004-09-26', 'L', '10-TKJ'),
(64, '103', 'Djajadi Djaja', 'Lampung', '2004-10-10', 'P', '12-PKM'),
(65, '104', 'Ratna Christina', 'Jambi', '2006-12-20', 'P', '11-AKL'),
(66, '105', 'Agus Djohari', 'Sulawesi selatan', '2004-11-22', 'P', '11-AKL'),
(68, '107', 'Erna Widyastuti', 'Papua', '2005-02-24', 'P', '11-BDP'),
(69, '108', 'Mustofa', 'Maluku utara', '2005-11-14', 'L', '10-PKM'),
(70, '109', 'Elvina Jonas Jahja', 'Sulawesi selatan', '2004-07-11', 'P', '11-AKL'),
(71, '110', 'Patrick Walujo', 'Jawa tengah', '2005-05-19', 'L', '10-TKJ'),
(72, '111', 'Edy Kosasih', 'Kepulauan riau', '2006-07-26', 'P', '10-OTKP'),
(73, '112', 'Saiko Doi', 'Riau', '2005-12-02', 'P', '12-RPL'),
(74, '113', 'Raymond Patra', 'Kalimantan barat', '2005-10-18', 'P', '12-TKJ'),
(75, '114', 'El Beatrice', 'Papua barat', '2004-06-08', 'P', '12-BDP'),
(76, '115', 'Hadi Lukman', 'Maluku utara', '2005-01-21', 'L', '12-RPL'),
(77, '116', 'Charterhouse Limited', 'Sulawesi tengah', '2005-08-19', 'P', '10-RPL'),
(78, '117', 'Chan Hiong Poh', 'Gorontalo', '2005-03-23', 'P', '12-AKL'),
(79, '118', 'Bismarka Kurniawan', 'Bali', '2004-12-12', 'P', '11-MM'),
(80, '119', 'Jotaro Kujo', 'Maluku', '2004-12-15', 'L', '11-PKM'),
(81, '120', 'Bob Yanuar', 'Sulawesi tengah', '2004-06-10', 'P', '10-AKL'),
(83, '122', 'Zaini Abidin Noor', 'Sulawesi selatan', '2005-09-21', 'P', '11-PKM'),
(84, '123', 'Triyatno Atmodiharjo', 'Sulawesi selatan', '2006-06-18', 'P', '10-PKM'),
(85, '124', 'Enny Soegiarto', 'Sumatera barat', '2005-06-07', 'L', '10-RPL'),
(86, '125', 'Erick Djuwadi', 'Kalimantan barat', '2006-09-23', 'L', '12-PKM'),
(87, '126', 'Oentoro Surya', 'Nusa tenggara timur', '2006-07-12', 'L', '11-RPL'),
(88, '127', 'Era Helvani', 'Lampung', '2005-05-16', 'P', '11-BDP');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id_user` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`id_user`, `user`, `pass`) VALUES
(1, 'admin', '$2y$10$GjolITKFSaBSBdc5tH.C8.UZ7IsBpjbnQXbGyM6Dxslyl7/Z8un7C');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `user`, `pass`, `nama_lengkap`, `no_hp`, `email`, `role`) VALUES
(46, 'test', '$2y$10$6GeVcq3sNwudHzjwqr4Vn.mkWL/8Yomb.WknrF4FS2JDWjjwmIXU6', 'test', '12', '123@gmail.com', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_siswa`
--
ALTER TABLE `info_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_siswa`
--
ALTER TABLE `info_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



