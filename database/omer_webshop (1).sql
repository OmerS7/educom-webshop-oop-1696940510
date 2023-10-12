-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 10 okt 2023 om 16:42
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
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `orderNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `userId`, `orderDate`, `orderNumber`) VALUES
(7, 6, '2023-10-06', 2023000001),
(8, 6, '2023-10-06', 2023000002),
(33, 6, '2023-10-06', 2023000003),
(34, 6, '2023-10-09', 2023000004),
(35, 6, '2023-10-09', 2023000005),
(36, 6, '2023-10-09', 2023000006),
(37, 6, '2023-10-09', 2023000007),
(38, 6, '2023-10-10', 2023000008),
(39, 6, '2023-10-10', 2023000009),
(40, 6, '2023-10-10', 2023000010);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productline`
--

CREATE TABLE `productline` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `productline`
--

INSERT INTO `productline` (`id`, `orderid`, `productid`, `amount`) VALUES
(3, 7, 4, 1),
(4, 7, 5, 2),
(5, 7, 1, 1),
(6, 8, 2, 1),
(12, 33, 1, 1),
(13, 34, 1, 2),
(14, 35, 1, 1),
(15, 36, 1, 1),
(16, 37, 1, 1),
(17, 38, 2, 1),
(18, 39, 5, 1),
(19, 40, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `productId` int(50) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `productimage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`productId`, `productname`, `description`, `price`, `productimage`) VALUES
(1, 'Nike Airforce 1', 'Behoud je stijlvolle look in de Nike Air Force 1 \'07, de basketbalschoen die een nieuwe draai geeft aan je favoriete onderdelen: stevig gestikte overlays, strakke afwerkingen en precies de juiste hoeveelheid glans zodat jij kunt schitteren.', 119.99, 'nikeairforce1.png'),
(2, 'Nike Dunk Low', 'Nike Dunk Low LIGHTBLUE', 99.99, 'nikedunklowblue.png'),
(3, 'Air Jordan 4', 'Unieke sneaker', 240.99, 'airjordan4.png'),
(4, 'Nike Calm Slides', 'Unieke slippers', 79.99, 'nikeslides.png'),
(5, 'Nike Socks', 'Nike Everyday Trainingssokken ', 14.99, 'nikesokken.png');

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
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexen voor tabel `productline`
--
ALTER TABLE `productline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `productId` (`productId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT voor een tabel `productline`
--
ALTER TABLE `productline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `productline`
--
ALTER TABLE `productline`
  ADD CONSTRAINT `productline_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `productline_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
