-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 25 sep 2023 om 14:53
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omer_webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `salutation` varchar(11) NOT NULL,
  `communication` varchar(20) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `salutation`, `communication`, `comment`) VALUES
(1, 'jan', 6040032, 'jan@hotmail.com', 'heer', 'E-mail', 'test'),
(2, 'koen', 62341234, 'koen@hotmail.com', 'heer', 'E-mail', 'test2'),
(3, 'Omer Seker', 6341234, 'otseker@hotmail.com', 'sir', 'E-mailadres', 'test'),
(4, 'Omer Seker', 6341234, 'otseker@hotmail.com', 'sir', 'E-mailadres', 'test'),
(5, 'Omer Seker', 6341234, 'otseker@hotmail.com', 'sir', 'E-mailadres', 'test'),
(6, 'Omer Seker', 6341234, 'otseker@hotmail.com', 'sir', 'E-mailadres', 'test'),
(7, 'kim', 65858585, 'kim@gmail.com', 'madam', 'Telefoonnummer', 'test3'),
(8, 'kim', 65858585, 'kim@gmail.com', 'madam', 'Telefoonnummer', 'test3'),
(9, 'kim', 65858585, 'kim@gmail.com', 'madam', 'Telefoonnummer', 'test3'),
(10, 'kim', 65858585, 'kim@gmail.com', 'madam', 'Telefoonnummer', 'test3'),
(11, 'kim', 65858585, 'kim@gmail.com', 'madam', 'Telefoonnummer', 'test3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Geert Wegemans', 'coach@man-kind.nl', 'halt!'),
(2, 'Jeroen Heemskerk', 'jeroen.heemskerk@educom.nu', 'A1B2C3'),
(4, 'Random', 'random@hotmail.com', 'random'),
(5, 'koen', 'koen@hotmail.com', 'koen'),
(6, 'Omer Seker', 'otseker@hotmail.com', 'hi'),
(7, 'nicole', 'nicole@hotmail.com', 'nicole');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
