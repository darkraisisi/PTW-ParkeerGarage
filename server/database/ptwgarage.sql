-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jan 2020 om 10:46
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptwgarage`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parkeergarage`
--

CREATE TABLE `parking_garage` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `place` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parkeerplek`
--

CREATE TABLE `parking_spot` (
  `garage` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `occupation` int(11) NOT NULL,
  `reserve_untill` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `parkeergarage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `parkeerplek`
--
ALTER TABLE `parking_spot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parking_garage_id` (`parking_garage`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `parkeergarage`
--
ALTER TABLE `parking_garage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `parkeerplek`
--
ALTER TABLE `parking_spot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `parkeerplek`
--
ALTER TABLE `parking_spot`
  ADD CONSTRAINT `parking_garage_id` FOREIGN KEY (`parking_garage`) REFERENCES `parking_garage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
