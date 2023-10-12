-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 12:32 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingsysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings_record`
--

CREATE TABLE `bookings_record` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(250) NOT NULL,
  `LASTNAME` varchar(250) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings_record`
--

INSERT INTO `bookings_record` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `PHONE`, `ADDRESS`, `DATE`) VALUES
(50, 'yu', 'n', 'oiy@gmail.com', '098', 'klj', '2023-06-22'),
(51, 'ytta', 'tyrgf', 'zhaskyamaynetta@gmail.com', '083562794', 'ytta', '2023-07-05'),
(52, 'ardita', 'savira', 'queenehee22@gmail.com', '089687045941', 'jl tanimbar', '2023-06-25'),
(53, 'Fikri', 'MA', 'test@test.test', '089999999999', 'jl.ada', '2023-06-23'),
(54, 'amaris', 'judith', 'pandaaapinky@gmail.com', '085789727161', 'perum gadang regency', '2023-06-24'),
(55, 'lala', 'lili', 'lalalili@gmail.com', '0000000001111', 'jalan.lalalili Gg.haha', '2023-06-24'),
(57, 'isd', 'asdasd', 'zulfanhnwd@gmail.com', '029188283', 'asdasd', '2023-07-13'),
(58, 'Muhammad', 'Zulfan', 'zulfanhnwd@gmail.com', '08970537844', 'Jl Jalan', '2023-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `data_fasilitas`
--

CREATE TABLE `data_fasilitas` (
  `id` int(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_fasilitas`
--

INSERT INTO `data_fasilitas` (`id`, `nama`, `layanan`, `harga`) VALUES
(1, 'Labana', 'Ekstrakulikuler', '120000'),
(2, 'Labana', 'Wedding', '100000'),
(3, 'Labana', 'Perlombaan', '150000'),
(4, 'Hall', 'Rapat', '75000'),
(5, 'Hall', 'Wedding', '100000'),
(6, 'Hall', 'Press Conference', '120000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings_record`
--
ALTER TABLE `bookings_record`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings_record`
--
ALTER TABLE `bookings_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
