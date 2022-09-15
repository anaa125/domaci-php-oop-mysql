-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 03:04 PM
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
-- Database: `domaci1`
--
CREATE DATABASE IF NOT EXISTS `domaci1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `domaci1`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnickoIme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnickoIme`, `lozinka`) VALUES
(1, 'admin', 'admin'),
(2, 'radnik', 'radnik'),
(3, 'ana', 'ana');

-- --------------------------------------------------------

--
-- Table structure for table `prikaz`
--

DROP TABLE IF EXISTS `prikaz`;
CREATE TABLE `prikaz` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sala` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trajanje` int(11) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `korisnikID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prikaz`
--

INSERT INTO `prikaz` (`id`, `naziv`, `sala`, `trajanje`, `datum`, `korisnikID`) VALUES
(1, 'LORENCAČO', 'sala 1', 97, '2022-09-22', 1),
(2, 'ALISA U ZEMLJI STRAHOVA', 'sala 2', 115, '2022-09-30', 0),
(3, 'ŠIROKA ZEMLJA ', 'sala 2', 97, '2022-10-04', 5),
(5, 'ZAGREB-BEOGRAD VIA SARAJEVO', 'sala 1', 96, '2022-09-27', 3),
(6, 'UJKA VANJA', 'sala 2', 114, '2022-09-24', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prikaz`
--
ALTER TABLE `prikaz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prikaz_ibfk_1` (`korisnikID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prikaz`
--
ALTER TABLE `prikaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
