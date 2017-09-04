-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2017 at 06:39 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza_kons`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerije`
--

CREATE TABLE `galerije` (
  `id` int(2) UNSIGNED NOT NULL,
  `nazivGalerije` varchar(250) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerije`
--

INSERT INTO `galerije` (`id`, `nazivGalerije`, `autor`, `datum`) VALUES
(11, 'Residence"Zeleny mis"', 'ttom1994', '2017-09-03 18:19:00'),
(8, 'Residence"GORKY-2"', 'ttom1994', '2017-09-02 15:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `galerijeslike`
--

CREATE TABLE `galerijeslike` (
  `id` int(3) UNSIGNED NOT NULL,
  `idGalerije` int(2) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `komentar` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerijeslike`
--

INSERT INTO `galerijeslike` (`id`, `idGalerije`, `slika`, `komentar`) VALUES
(21, 11, '1504463835_1.jpg', ''),
(20, 11, '1504463812_1.jpg', ''),
(19, 11, '1504463484_1.jpg', ''),
(18, 8, '1504463225_2.jpg', 'Swimming pool'),
(16, 8, '1504461209_2.jpg', 'New design'),
(15, 8, '1504461209_1.jpg', 'Living room'),
(17, 8, '1504463225_1.jpg', 'Tennis court'),
(13, 8, '1504461178_1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(4) UNSIGNED NOT NULL,
  `idVesti` int(3) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `volime` int(3) NOT NULL DEFAULT '0',
  `nevolime` int(3) NOT NULL DEFAULT '0',
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dozvoljen` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `idVesti`, `autor`, `tekst`, `volime`, `nevolime`, `datum`, `dozvoljen`) VALUES
(35, 51, 'Dimitrije', 'Nice', 0, 0, '2017-09-03 17:47:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(2) UNSIGNED NOT NULL,
  `korime` varchar(50) NOT NULL,
  `lozinka` varchar(256) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korime`, `lozinka`, `ime`, `status`) VALUES
(1, 'ttom1994', 'ttom1994', 'Kovačević Dimitrije', 'Administrator'),
(11, 'Stele', 'stex', '.Stefan Gavrilovic.', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(3) UNSIGNED NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `sadrzaj` text NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `napisao` varchar(50) NOT NULL,
  `kategorija` enum('Apartments','Residences','Swimming pools and spa','Office fit out') NOT NULL,
  `slika` varchar(50) DEFAULT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `sadrzaj`, `datum`, `napisao`, `kategorija`, `slika`, `obrisan`) VALUES
(51, 'Residence"Zeleny mis"', 'Adres - Zeleny mis, Moscow<br>\r\nArea - 600 m2<br>\r\nPrivate customer', '2017-09-03 12:57:02', 'ttom1994', 'Residences', '1504436222.jpg', 0),
(38, 'Apartment', 'Adres - m.Aviamotornaya, Moscow<br>\r\nProject- Architectural studio ARCH4<br>\r\nArea - 70 m2<br>\r\nPrivate custome', '2017-09-02 15:43:47', 'ttom1994', 'Apartments', '1504437351.', 0),
(50, 'Swimming pool', 'Residence"GORKY-2"<br>\r\nAdres - Odintsovo , Moscow<br>\r\nArea - 3500 m2<br>\r\nPrivate customer', '2017-09-03 12:49:15', 'ttom1994', 'Swimming pools and spa', '1504440709.', 0),
(53, 'Something new', 'Mosaics', '2017-09-03 20:36:10', 'ttom1994', 'Swimming pools and spa', '1504463770.jpg', 0),
(46, 'Office', 'Adres - Moscow\r\nArea - 1000 m2', '2017-09-02 17:28:46', 'ttom1994', 'Office fit out', '1504440124.', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galerije`
--
ALTER TABLE `galerije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `vesti` ADD FULLTEXT KEY `slika` (`slika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerije`
--
ALTER TABLE `galerije`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
