-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 03:46 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olympic_registration_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `contingent`
--

CREATE TABLE `contingent` (
  `faculty_name` varchar(75) NOT NULL,
  `username` varchar(50) NOT NULL,
  `leader_name` varchar(75) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `name` varchar(75) NOT NULL,
  `auth_token` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`name`, `auth_token`) VALUES
('Fakultas Ekonomi dan Bisnis', ''),
('Fakultas Farmasi', ''),
('Fakultas Hukum', ''),
('Fakultas Ilmu Administrasi', ''),
('Fakultas Ilmu Keperawatan', ''),
('Fakultas Ilmu Komputer', ''),
('Fakultas Ilmu Pengetahuan Budaya', ''),
('Fakultas Ilmu Sosial dan Ilmu Politik', ''),
('Fakultas Kedokteran', ''),
('Fakultas Kedokteran Gigi', ''),
('Fakultas Kesehatan Masyarakat', ''),
('Fakultas Matematika dan Ilmu Pengetahuan Alam', ''),
('Fakultas Psikologi', ''),
('Fakultas Teknik', ''),
('Program Vokasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_sport`
--

CREATE TABLE `faculty_sport` (
  `faculty_name` varchar(75) NOT NULL,
  `sport_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `official_sport`
--

CREATE TABLE `official_sport` (
  `official_faculty_name` varchar(75) NOT NULL,
  `official_npm` char(10) NOT NULL,
  `category` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `olimpiad`
--

CREATE TABLE `olimpiad` (
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `olimpiad`
--

INSERT INTO `olimpiad` (`username`, `password`) VALUES
('olimpiad_committee', 'ab7da75f71fc9ab0e22ecee0ec44633e28e69ef2');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `faculty_name` varchar(75) NOT NULL,
  `npm` char(10) NOT NULL,
  `full_name` varchar(75) NOT NULL,
  `major` varchar(75) NOT NULL,
  `image_link` varchar(256) NOT NULL,
  `id_card_link` varchar(256) NOT NULL,
  `screenshot_link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant_sport`
--

CREATE TABLE `participant_sport` (
  `participant_faculty_name` varchar(75) NOT NULL,
  `participant_npm` char(10) NOT NULL,
  `sport_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `name` varchar(100) NOT NULL,
  `category` varchar(75) NOT NULL,
  `max_player` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`name`, `category`, `max_player`) VALUES
('Badminton Ganda Campuran', 'Badminton', 4),
('Badminton Ganda Putra', 'Badminton', 4),
('Badminton Ganda Putri', 'Badminton', 4),
('Badminton Tunggal Putra', 'Badminton', 3),
('Badminton Tunggal Putri', 'Badminton', 3),
('Basket Putra', 'Basket', 15),
('Basket Putri', 'Basket', 15),
('Estafet 4 x 100 meter putra', 'Atletik', 4),
('Estafet 4 x 100 meter putri', 'Atletik', 4),
('Futsal Putra', 'Futsal', 15),
('Futsal Putri', 'Futsal', 15),
('Hockey Campuran', 'Hockey', 18),
('Lari 100 meter putra', 'Atletik', 2),
('Lari 100 meter putri', 'Atletik', 2),
('Lari 1500 meter putra', 'Atletik', 2),
('Lari 1500 meter putri', 'Atletik', 2),
('Lari 200 meter putra', 'Atletik', 2),
('Lari 200 meter putri', 'Atletik', 2),
('Lari 400 meter putra', 'Atletik', 2),
('Lari 400 meter putri', 'Atletik', 2),
('Lari 800 meter putra', 'Atletik', 2),
('Lari 800 meter putri', 'Atletik', 2),
('Lari Marathon Putra', 'Atletik', 3),
('Lari Marathon Putri', 'Atletik', 3),
('Lempar Lembing Putra', 'Atletik', 1),
('Lompat jauh putra', 'Atletik', 1),
('Lompat jauh putri', 'Atletik', 1),
('Renang 4 x 50 Meter Estafet Bebas Putra', 'Renang', 5),
('Renang 4 x 50 Meter Estafet Bebas Putri', 'Renang', 5),
('Renang 4 x 50 Meter Estafet Ganti Putra', 'Renang', 5),
('Renang 4 x 50 Meter Estafet Ganti Putri', 'Renang', 5),
('Renang 50 Meter Gaya Bebas Putra', 'Renang', 2),
('Renang 50 Meter Gaya Bebas Putri', 'Renang', 2),
('Renang 50 Meter Gaya Dada Putra', 'Renang', 2),
('Renang 50 Meter Gaya Dada Putri', 'Renang', 2),
('Renang 50 Meter Gaya Kupu-Kupu Putra', 'Renang', 2),
('Renang 50 Meter Gaya Kupu-Kupu Putri', 'Renang', 2),
('Renang 50 Meter Gaya Punggung Putra', 'Renang', 2),
('Renang 50 Meter Gaya Punggung Putri', 'Renang', 2),
('Sepak Bola Putra', 'Sepak Bola', 22),
('Taekwondo Putra Over 87 Kg', 'Taekwondo', 2),
('Taekwondo Putra Poomsae', 'Taekwondo', 2),
('Taekwondo Putra Under 54 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 58 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 63 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 68 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 74 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 80 Kg', 'Taekwondo', 2),
('Taekwondo Putra Under 87 Kg', 'Taekwondo', 2),
('Taekwondo Putri Over 73 Kg', 'Taekwondo', 2),
('Taekwondo Putri Poomsae', 'Taekwondo', 2),
('Taekwondo Putri Under 46 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 49 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 53 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 57 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 62 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 67 Kg', 'Taekwondo', 2),
('Taekwondo Putri Under 73 Kg', 'Taekwondo', 2),
('Tenis Lapangan Ganda Campuran', 'Tenis Lapangan', 4),
('Tenis Lapangan Ganda Putra', 'Tenis Lapangan', 4),
('Tenis Lapangan Ganda Putri', 'Tenis Lapangan', 4),
('Tenis Lapangan Tunggal Putra', 'Tenis Lapangan', 2),
('Tenis Lapangan Tunggal Putri', 'Tenis Lapangan', 2),
('Tenis Meja Beregu', 'Tenis Meja', 12),
('Tenis Meja Ganda Campuran', 'Tenis Meja', 4),
('Tenis Meja Ganda Putra', 'Tenis Meja', 4),
('Tenis Meja Ganda Putri', 'Tenis Meja', 4),
('Tenis Meja Tunggal Putra', 'Tenis Meja', 2),
('Tenis Meja Tunggal Putri', 'Tenis Meja', 2),
('Tolak Peluru Putri', 'Atletik', 1),
('Voli Putra', 'Voli', 12),
('Voli Putri', 'Voli', 12);

-- --------------------------------------------------------

--
-- Table structure for table `sport_category`
--

CREATE TABLE `sport_category` (
  `category` varchar(75) NOT NULL,
  `max_official` int(10) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sport_category`
--

INSERT INTO `sport_category` (`category`, `max_official`, `start_date`, `end_date`) VALUES
('Atletik', 2, '2018-10-27 00:00:00', '2018-10-29 21:00:00'),
('Badminton', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Basket', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Futsal', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Hockey', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Renang', 2, '2018-11-03 00:00:00', '2018-11-05 21:00:00'),
('Sepak Bola', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Taekwondo', 2, '2018-11-10 00:00:00', '2018-11-12 21:00:00'),
('Tenis Lapangan', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00'),
('Tenis Meja', 2, '2018-09-04 00:00:00', '2018-10-14 21:00:00'),
('Voli', 2, '2018-10-04 00:00:00', '2018-10-14 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contingent`
--
ALTER TABLE `contingent`
  ADD PRIMARY KEY (`username`,`faculty_name`),
  ADD KEY `contingent_faculty` (`faculty_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `faculty_sport`
--
ALTER TABLE `faculty_sport`
  ADD PRIMARY KEY (`faculty_name`,`sport_name`),
  ADD KEY `sport_foreign_key` (`sport_name`);

--
-- Indexes for table `official_sport`
--
ALTER TABLE `official_sport`
  ADD PRIMARY KEY (`official_faculty_name`,`official_npm`,`category`),
  ADD KEY `sport_category_foreign_key` (`category`);

--
-- Indexes for table `olimpiad`
--
ALTER TABLE `olimpiad`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`faculty_name`,`npm`);

--
-- Indexes for table `participant_sport`
--
ALTER TABLE `participant_sport`
  ADD PRIMARY KEY (`participant_faculty_name`,`participant_npm`,`sport_name`),
  ADD KEY `faculty_sport_foreign_key` (`participant_faculty_name`,`sport_name`),
  ADD KEY `sport_foreign_key2` (`sport_name`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`name`),
  ADD KEY `category_foreign_key` (`category`);

--
-- Indexes for table `sport_category`
--
ALTER TABLE `sport_category`
  ADD PRIMARY KEY (`category`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contingent`
--
ALTER TABLE `contingent`
  ADD CONSTRAINT `contingent_faculty` FOREIGN KEY (`faculty_name`) REFERENCES `faculty` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_sport`
--
ALTER TABLE `faculty_sport`
  ADD CONSTRAINT `faculty_foreign_key` FOREIGN KEY (`faculty_name`) REFERENCES `faculty` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_foreign_key` FOREIGN KEY (`sport_name`) REFERENCES `sport` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `official_sport`
--
ALTER TABLE `official_sport`
  ADD CONSTRAINT `official_foreign_key` FOREIGN KEY (`official_faculty_name`,`official_npm`) REFERENCES `participant` (`faculty_name`, `npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_category_foreign_key` FOREIGN KEY (`category`) REFERENCES `sport_category` (`category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_faculty` FOREIGN KEY (`faculty_name`) REFERENCES `faculty` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_sport`
--
ALTER TABLE `participant_sport`
  ADD CONSTRAINT `faculty_sport_foreign_key` FOREIGN KEY (`participant_faculty_name`,`sport_name`) REFERENCES `faculty_sport` (`faculty_name`, `sport_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_foreign_key` FOREIGN KEY (`participant_faculty_name`,`participant_npm`) REFERENCES `participant` (`faculty_name`, `npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_foreign_key2` FOREIGN KEY (`sport_name`) REFERENCES `sport` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sport`
--
ALTER TABLE `sport`
  ADD CONSTRAINT `category_foreign_key` FOREIGN KEY (`category`) REFERENCES `sport_category` (`category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
