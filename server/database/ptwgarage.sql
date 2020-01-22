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

CREATE TABLE `parkeergarage` (
  `id` int(11) NOT NULL,
  `naam` varchar(250) NOT NULL,
  `plaats` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `parkeergarage`
--

INSERT INTO `parkeergarage` (`id`, `naam`, `plaats`) VALUES
(1, 'Utrecht Centrum', 'Utrecht'),
(2, 'Overvecht', 'Utrecht');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parkeerplek`
--

CREATE TABLE `parkeerplek` (
  `parkeergarage` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `nummer` int(11) NOT NULL,
  `bezetting` int(11) NOT NULL,
  `reservering_tot` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `parkeergarage`
--
ALTER TABLE `parkeergarage`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `parkeerplek`
--
ALTER TABLE `parkeerplek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parkeergarage_id` (`parkeergarage`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `parkeergarage`
--
ALTER TABLE `parkeergarage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `parkeerplek`
--
ALTER TABLE `parkeerplek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `parkeerplek`
--
ALTER TABLE `parkeerplek`
  ADD CONSTRAINT `parkeergarage_id` FOREIGN KEY (`parkeergarage`) REFERENCES `parkeergarage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
