-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Sie 2022, 14:26
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sample_php_advance`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `currencies`
--

INSERT INTO `currencies` (`id`, `currency`) VALUES
(1, 'THB '),
(2, 'USD'),
(3, 'AUD'),
(4, 'HKD'),
(5, 'CAD'),
(6, 'NZD'),
(7, 'SGD'),
(8, 'EUR'),
(9, 'HUF'),
(10, 'CHF'),
(11, 'GBP'),
(12, 'UAH'),
(13, 'JPY'),
(14, 'CZK'),
(15, 'DKK'),
(16, 'ISK'),
(17, 'NOK'),
(18, 'SEK'),
(19, 'HRK'),
(20, 'RON'),
(21, 'BGN'),
(22, 'TRY'),
(23, 'ILS'),
(24, 'CLP'),
(25, 'PHP'),
(26, 'MXN'),
(27, 'ZAR'),
(28, 'BRL'),
(29, 'MYR'),
(30, 'IDR'),
(31, 'INR'),
(32, 'KRW'),
(33, 'CNY'),
(34, 'XDR');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(225) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `currency` text NOT NULL,
  `amount` float NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
