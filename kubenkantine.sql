-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 08:23 AM
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
-- Database: `kubenkantine`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestilling`
--

CREATE TABLE `bestilling` (
  `Bestillingsnummer` int(11) NOT NULL,
  `Kundenummer` int(11) NOT NULL,
  `Bestillingsdato` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsReady` tinyint(1) NOT NULL DEFAULT 0,
  `isPickedUp` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bestilling`
--

INSERT INTO `bestilling` (`Bestillingsnummer`, `Kundenummer`, `Bestillingsdato`, `IsReady`, `isPickedUp`) VALUES
(8, 17, '0000-00-00 00:00:00', 0, 0),
(9, 17, '0000-00-00 00:00:00', 0, 1),
(11, 17, '0000-00-00 00:00:00', 0, 0),
(12, 17, '0000-00-00 00:00:00', 0, 0),
(13, 17, '0000-00-00 00:00:00', 0, 0),
(14, 21, '0000-00-00 00:00:00', 0, 0),
(15, 21, '0000-00-00 00:00:00', 0, 0),
(16, 21, '0000-00-00 00:00:00', 0, 0),
(17, 21, '0000-00-00 00:00:00', 0, 0),
(18, 21, '0000-00-00 00:00:00', 0, 0),
(19, 21, '0000-00-00 00:00:00', 0, 0),
(20, 21, '0000-00-00 00:00:00', 0, 0),
(21, 21, '2023-12-03 23:00:00', 0, 0),
(22, 21, '2023-12-04 10:02:56', 0, 0),
(23, 21, '2023-12-04 10:13:53', 0, 0),
(24, 21, '2023-12-04 10:13:57', 0, 0),
(25, 21, '2023-12-04 10:14:03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(3, 'How do I create an appointment?', 'Go to the calender, if you have the correct rights there is a form underneath.'),
(4, 'If i dont have rights to create appointments, how do I get it?', 'Only Administrator can change users rights. Ask your Administrator, they will need your username or email.');

-- --------------------------------------------------------

--
-- Table structure for table `produkter`
--

CREATE TABLE `produkter` (
  `id` int(11) NOT NULL,
  `navn` varchar(255) NOT NULL,
  `beskrivelse` text DEFAULT NULL,
  `pris` decimal(10,2) DEFAULT NULL,
  `lagerbeholdning` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `dag` varchar(25) NOT NULL,
  `klokkeslett` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkter`
--

INSERT INTO `produkter` (`id`, `navn`, `beskrivelse`, `pris`, `lagerbeholdning`, `type`, `dag`, `klokkeslett`) VALUES
(4, 'Pasta', 'Hovedrett - Mandag', 40.00, 100, 'Hovedrett', 'Monday', '10:00'),
(5, 'Hamburger', 'Hovedrett - Tirsdag', 40.00, 100, 'Hovedrett', 'Tuesday', '10:00'),
(6, 'Pizzastykke', 'Hovedrett - Onsdag', 28.00, 100, 'Hovedrett', 'Wednesday', '10:00'),
(7, 'Kebab', 'Hovedrett - Torsdag', 40.00, 100, 'Hovedrett', 'Thursday', '10:00'),
(8, 'Fish \'n chips', 'Hovedrett - Fredag', 40.00, 100, 'Hovedrett', 'Friday', '10:00'),
(9, 'Børek (vegetar)', 'Vegetar', 30.00, 100, 'Meny', 'Alle', '09:00'),
(10, 'Pide (mini-pizza)', 'Mini-pizza', 30.00, 100, 'Meny', 'Alle', '09:00'),
(11, 'Skinkesløyfer', 'Skinkesløyfer', 30.00, 100, 'Meny', 'Alle', '09:00'),
(12, 'Baguette (fin/grov)', 'Baguette', 45.00, 100, 'Meny', 'Alle', '09:00'),
(13, 'Salat (vegetar/kjøtt)', 'Salat', 35.00, 100, 'Meny', 'Alle', '09:00'),
(14, 'Osteflutes (vegetar/kjøtt)', 'Osteflutes', 45.00, 100, 'Meny', 'Alle', '09:00'),
(15, 'Frøsub', 'Frøsub', 45.00, 100, 'Meny', 'Alle', '09:00'),
(16, 'Yt', 'Drikke', 28.00, 100, 'Drikke', 'Alle', 'Alle'),
(17, 'Litago', 'Drikke', 25.00, 100, 'Drikke', 'Alle', 'Alle'),
(18, '1⁄2 liter melk', 'Drikke', 15.00, 100, 'Drikke', 'Alle', 'Alle'),
(19, 'Pepsi/ Solo', 'Drikke', 30.00, 100, 'Drikke', 'Alle', 'Alle'),
(20, 'Noisy', 'Drikke', 25.00, 100, 'Drikke', 'Alle', 'Alle'),
(21, 'Isklar', 'Drikke', 20.00, 100, 'Drikke', 'Alle', 'Alle'),
(22, 'Iste', 'Drikke', 30.00, 100, 'Drikke', 'Alle', 'Alle'),
(23, 'Kaffe', 'Drikke', 14.00, 100, 'Drikke', 'Alle', 'Alle'),
(24, 'Iskaffe', 'Drikke', 25.00, 100, 'Drikke', 'Alle', 'Alle'),
(25, 'Slush', 'Drikke', 25.00, 100, 'Drikke', 'Alle', 'Alle'),
(26, 'Liten juice', 'Drikke', 15.00, 100, 'Drikke', 'Alle', 'Alle'),
(27, 'Muffins', 'Kake', 18.00, 100, 'Kake', 'Alle', 'Alle'),
(28, 'Cookie', 'Kake', 16.00, 100, 'Kake', 'Alle', 'Alle'),
(29, 'Kanelsnurr', 'Kake', 25.00, 100, 'Kake', 'Alle', 'Alle'),
(30, 'Belgisk vaffel', 'Kake', 18.00, 100, 'Kake', 'Alle', 'Alle');

-- --------------------------------------------------------

--
-- Table structure for table `produkt_i_bestilling`
--

CREATE TABLE `produkt_i_bestilling` (
  `Bestillingsnummer` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `Antall` int(11) NOT NULL,
  `Pris` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkt_i_bestilling`
--

INSERT INTO `produkt_i_bestilling` (`Bestillingsnummer`, `ProduktID`, `Antall`, `Pris`) VALUES
(9, 4, 3, 40.00),
(9, 15, 3, 45.00),
(11, 27, 1, 18.00),
(11, 8, 1, 40.00),
(13, 8, 1, 40.00),
(14, 16, 1, 28.00),
(14, 20, 2, 25.00),
(16, 4, 1, 40.00),
(17, 16, 1, 28.00),
(17, 17, 1, 25.00),
(18, 16, 1, 28.00),
(20, 4, 1, 40.00),
(21, 4, 1, 40.00),
(21, 16, 1, 28.00),
(21, 17, 2, 25.00),
(22, 4, 1, 40.00),
(24, 4, 1, 40.00),
(25, 4, 1, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `isAdmin`) VALUES
(17, 'admin', 'admin@admin.admin', '$2y$12$1i9EEM0OBCeu1xSJRdwAV.1vUY/6F47zUZca4Ld8bpuyIczWsvLMO', '2023-11-19 22:01:46', 2),
(18, 'Ansatt', 'Ansatt123@ansatt.com', '$2y$12$IY1.uGVh52.bGqmbGKfE3.6StBIrdbdsWNTEnHpHPCyMSE3iSo.zG', '2023-11-30 12:16:53', 1),
(21, 'Kunde', 'kunde@kunde.com', '$2y$12$AdmB7LEwWifDMiL1QELYaeDJH.7D/ewZJlNykMiXLgMIH3OVIdYMO', '2023-12-04 08:06:18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestilling`
--
ALTER TABLE `bestilling`
  ADD PRIMARY KEY (`Bestillingsnummer`),
  ADD KEY `Kundenummer` (`Kundenummer`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkter`
--
ALTER TABLE `produkter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkt_i_bestilling`
--
ALTER TABLE `produkt_i_bestilling`
  ADD KEY `ProduktID` (`ProduktID`),
  ADD KEY `fk_produkt_i_bestilling_bestilling` (`Bestillingsnummer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestilling`
--
ALTER TABLE `bestilling`
  MODIFY `Bestillingsnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produkter`
--
ALTER TABLE `produkter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
