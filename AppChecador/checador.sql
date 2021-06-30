-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2019 at 09:44 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checador`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `contrasena`) VALUES
(1, 'christian', 'cctur2019');

-- --------------------------------------------------------

--
-- Table structure for table `prestadores`
--

CREATE TABLE `prestadores` (
  `idPrestador` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `totalhoras` int(11) NOT NULL,
  `escuela` varchar(150) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestadores`
--

INSERT INTO `prestadores` (`idPrestador`, `nombre`, `totalhoras`, `escuela`, `fechaInicio`, `fechaFin`) VALUES
(1, 'Manuel Lopez', 480, 'FIMAZ', '2019-02-23', '2019-03-23'),
(2, 'Oscar Otanez', 480, 'FIMAZ', '2019-02-23', '2019-03-23'),
(3, 'Samuel Mendez', 480, 'FIMAZ', '2019-02-23', '2019-03-23'),
(4, 'Alberto Soto', 480, 'FIMAZ', '2019-02-24', '2019-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `statusprestador`
--

CREATE TABLE `statusprestador` (
  `idStatus` int(11) NOT NULL,
  `prestador` int(11) NOT NULL,
  `horasrestantes` int(11) NOT NULL,
  `fechaChecado` date NOT NULL,
  `entrada` varchar(50) NOT NULL,
  `salida` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusprestador`
--

INSERT INTO `statusprestador` (`idStatus`, `prestador`, `horasrestantes`, `fechaChecado`, `entrada`, `salida`) VALUES
(1, 1, 477, '0000-00-00', '11:45:26', '13:40:44'),
(2, 3, 479, '0000-00-00', '12:12:56', '13:40:06'),
(3, 2, 480, '2019-02-24', '12:14:54', '12:31:22'),
(5, 4, 480, '2019-02-24', '13:43:19', '13:43:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestadores`
--
ALTER TABLE `prestadores`
  ADD PRIMARY KEY (`idPrestador`);

--
-- Indexes for table `statusprestador`
--
ALTER TABLE `statusprestador`
  ADD PRIMARY KEY (`idStatus`),
  ADD KEY `prestador` (`prestador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prestadores`
--
ALTER TABLE `prestadores`
  MODIFY `idPrestador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statusprestador`
--
ALTER TABLE `statusprestador`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `statusprestador`
--
ALTER TABLE `statusprestador`
  ADD CONSTRAINT `statusprestador_ibfk_1` FOREIGN KEY (`prestador`) REFERENCES `prestadores` (`idPrestador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
