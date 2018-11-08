-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2018 at 05:07 AM
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
-- Database: `spk_jamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alt` int(11) NOT NULL,
  `nm_alternatif` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alt`, `nm_alternatif`, `keterangan`) VALUES
(1, 'Beras Kencur', 'Jamu Beras Kencur'),
(2, 'Kunyit Asam', 'Jamu Kunyit Asam'),
(3, 'Kunyit', 'Jamu Kunyit'),
(4, 'Pahit', 'Jamu Pahit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bobot_DEPRECATED`
--

CREATE TABLE `tbl_bobot_DEPRECATED` (
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_skala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bobot_DEPRECATED`
--

INSERT INTO `tbl_bobot_DEPRECATED` (`id_bobot`, `id_kriteria`, `id_skala`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nm_kriteria` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nm_kriteria`, `keterangan`, `bobot`) VALUES
(1, 'Rasa', 'Rasa jamu', 30),
(2, 'Khasiat', 'Khasiat Jamu', 40),
(3, 'Harga', 'Harga Jamu', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_skala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_alternatif`, `id_kriteria`, `id_skala`) VALUES
(1, 1, 3, 2),
(2, 1, 2, 3),
(3, 1, 1, 1),
(4, 3, 3, 2),
(5, 3, 2, 2),
(6, 3, 1, 2),
(7, 2, 3, 2),
(8, 2, 2, 2),
(9, 2, 1, 2),
(10, 4, 3, 3),
(11, 4, 2, 1),
(12, 4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_skala`
--

CREATE TABLE `tbl_skala` (
  `id_skala` int(11) NOT NULL,
  `nm_skala` varchar(20) NOT NULL,
  `value` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_skala`
--

INSERT INTO `tbl_skala` (`id_skala`, `nm_skala`, `value`) VALUES
(1, 'Baik', 90),
(2, 'Sedang', 70),
(3, 'Buruk', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alt`);

--
-- Indexes for table `tbl_bobot_DEPRECATED`
--
ALTER TABLE `tbl_bobot_DEPRECATED`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_skala` (`id_skala`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_skala` (`id_skala`);

--
-- Indexes for table `tbl_skala`
--
ALTER TABLE `tbl_skala`
  ADD PRIMARY KEY (`id_skala`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_bobot_DEPRECATED`
--
ALTER TABLE `tbl_bobot_DEPRECATED`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_skala`
--
ALTER TABLE `tbl_skala`
  MODIFY `id_skala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bobot_DEPRECATED`
--
ALTER TABLE `tbl_bobot_DEPRECATED`
  ADD CONSTRAINT `tbl_bobot_DEPRECATED_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`),
  ADD CONSTRAINT `tbl_bobot_DEPRECATED_ibfk_2` FOREIGN KEY (`id_skala`) REFERENCES `tbl_skala` (`id_skala`);

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id_alt`),
  ADD CONSTRAINT `tbl_nilai_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`),
  ADD CONSTRAINT `tbl_nilai_ibfk_3` FOREIGN KEY (`id_skala`) REFERENCES `tbl_skala` (`id_skala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
