-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2023 at 06:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libretaSanitaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `DUENIO`
--

CREATE TABLE `DUENIO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `MAIL` varchar(100) NOT NULL,
  `TELEFONO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HISTORIAL_DESPARASITACION`
--

CREATE TABLE `HISTORIAL_DESPARASITACION` (
  `ID` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `ID_LIBRETA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HISTORIAL_VACUNAS`
--

CREATE TABLE `HISTORIAL_VACUNAS` (
  `ID` int(11) NOT NULL,
  `ID_VACUNA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `ID_LIBRETA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `LIBRETA_SANITARIA`
--

CREATE TABLE `LIBRETA_SANITARIA` (
  `ID` int(11) NOT NULL COMMENT 'ID TABLA',
  `ID_DUENIO` int(11) NOT NULL,
  `ID_MASCOTA` int(11) NOT NULL,
  `ID_VETERINARIO` int(11) NOT NULL,
  `ID_HISTORIAL_VACUNAS` int(11) NOT NULL,
  `ID_HISTORIAL_DESPARASITACION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MASCOTAS`
--

CREATE TABLE `MASCOTAS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `EDAD` int(11) NOT NULL,
  `ID_TIPO_ANIMAL` int(11) NOT NULL,
  `PESO` double NOT NULL,
  `ID_RAZA_PERRO` int(11) DEFAULT NULL,
  `ID_RAZA_GATO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RAZA_GATO`
--

CREATE TABLE `RAZA_GATO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RAZA_PERRO`
--

CREATE TABLE `RAZA_PERRO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TIPO_ANIMAL`
--

CREATE TABLE `TIPO_ANIMAL` (
  `ID` int(11) NOT NULL,
  `ANIMAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VACUNAS`
--

CREATE TABLE `VACUNAS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VETERINARIO`
--

CREATE TABLE `VETERINARIO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `MAIL` varchar(100) NOT NULL,
  `TELEFONO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DUENIO`
--
ALTER TABLE `DUENIO`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `HISTORIAL_DESPARASITACION`
--
ALTER TABLE `HISTORIAL_DESPARASITACION`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `HISTORIAL_VACUNAS`
--
ALTER TABLE `HISTORIAL_VACUNAS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `LIBRETA_SANITARIA`
--
ALTER TABLE `LIBRETA_SANITARIA`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `MASCOTAS`
--
ALTER TABLE `MASCOTAS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `RAZA_GATO`
--
ALTER TABLE `RAZA_GATO`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `RAZA_PERRO`
--
ALTER TABLE `RAZA_PERRO`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TIPO_ANIMAL`
--
ALTER TABLE `TIPO_ANIMAL`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `VACUNAS`
--
ALTER TABLE `VACUNAS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `VETERINARIO`
--
ALTER TABLE `VETERINARIO`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DUENIO`
--
ALTER TABLE `DUENIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HISTORIAL_DESPARASITACION`
--
ALTER TABLE `HISTORIAL_DESPARASITACION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HISTORIAL_VACUNAS`
--
ALTER TABLE `HISTORIAL_VACUNAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LIBRETA_SANITARIA`
--
ALTER TABLE `LIBRETA_SANITARIA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID TABLA';

--
-- AUTO_INCREMENT for table `MASCOTAS`
--
ALTER TABLE `MASCOTAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RAZA_GATO`
--
ALTER TABLE `RAZA_GATO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RAZA_PERRO`
--
ALTER TABLE `RAZA_PERRO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TIPO_ANIMAL`
--
ALTER TABLE `TIPO_ANIMAL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VACUNAS`
--
ALTER TABLE `VACUNAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VETERINARIO`
--
ALTER TABLE `VETERINARIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
