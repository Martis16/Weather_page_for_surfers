-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2023 at 04:42 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vartvald`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ataskaita`
--

CREATE TABLE `Ataskaita` (
  `Laikas` time NOT NULL,
  `Vardas` varchar(20) NOT NULL,
  `Regionas` varchar(20) NOT NULL,
  `Kryptis` varchar(11) NOT NULL,
  `id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ataskaita`
--

INSERT INTO `Ataskaita` (`Laikas`, `Vardas`, `Regionas`, `Kryptis`, `id`) VALUES
('00:21:00', 'rokas', 'Aukštaitija', 'ŠR', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Naujas`
--

CREATE TABLE `Naujas` (
  `vardas` varchar(15) NOT NULL,
  `pastas` varchar(20) NOT NULL,
  `role` int(5) NOT NULL,
  `naujasslapt` varchar(20) NOT NULL,
  `laikas` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Oras`
--

CREATE TABLE `Oras` (
  `kryptis` varchar(10) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `greitis` double NOT NULL,
  `id` int(255) UNSIGNED NOT NULL,
  `miestas` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gusiogreitis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Oras`
--

INSERT INTO `Oras` (`kryptis`, `greitis`, `id`, `miestas`, `gusiogreitis`) VALUES
('Southwest', 2.5, 43, 'TelÅ¡iai', 4.3),
('Northwest', 6.4, 44, 'KlaipÄ—da', 10.6),
('East', 3.3, 75, 'MarijampolÄ—', 5.8),
('East', 3.6, 76, 'PanevÄ—Å¾ys', 6.2),
('East', 3.7, 77, 'Alytus', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) NOT NULL,
  `userlevel` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('Administratorius', '16c354b68848cdbd8f54a226a0a55b21', 'a2fe399900de341c39c632244eaf8483', 9, 'demo@ktu.lt', '2023-12-06 13:30:47'),
('rimas', 'c2acd92812ef99acd3dcdbb746b9a434', '689e5b2971577d707becb97405ede951', 9, 'rimas@litnet.lt', '2023-11-02 20:27:24'),
('jonas', '64067822105b320085d18e386f57d89a', '9c5ddd54107734f7d18335a5245c286b', 255, 'rimas@litnet.lt', '2017-05-09 17:10:37'),
('pranas', '16c354b68848cdbd8f54a226a0a55b21', 'aa69001f0ba493bed7dddfd1cdb06591', 5, 'pranas@ltu.ee', '2018-02-16 16:03:41'),
('kostas', '1c37511487d38c3ebc4c59650ce2d65a', '69986045e0925262d43addddaf76094f', 9, 'eeee@ll.lt', '2018-02-16 16:04:35'),
('martis', '898da28047151d0e56f8dc6292773603', 'c1d8772564d14bcb2372a4ef2e2bde1a', 5, 'martisburneika@gmail.com', '2023-12-06 13:50:08'),
('rokas', '50501b0361d9c69fc4102eb6fe5b1f5c', '4793c0303a7153e531e79ab956b1353c', 5, 'marbur4@ktu.lt', '2023-11-02 20:13:37'),
('matas', '71b78999671c9d22677a496f4ef1fe6d', 'ad6b729ee894812be4a00e68ffa08628', 4, 'matas@gmail.com', '2023-12-04 16:08:18'),
('tomas', '4ac8f47a3f662266dfd79b7464b12eca', '28638bb103133c6e6ca13b899597b616', 4, 'tomas@gmail.com', '2023-12-02 11:33:58'),
('haris', 'e29ecd5f502425fc6972fbe0cce96080', '28f0953ed676717d2ea81cb94dc3aa15', 255, 'haris@gmail.com', '2023-11-08 11:13:17'),
('gytis', '4ac8f47a3f662266dfd79b7464b12eca', 'd8ed67a4a066895c314d4ca8dba4e180', 4, 'gytis@gytis.lt', '2023-12-02 11:42:17'),
('enrika', '4ac8f47a3f662266dfd79b7464b12eca', '353837be67c9754819ae367c5e6de68e', 4, 'enr@gmail.com', '2023-12-06 13:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `Uzklausa`
--

CREATE TABLE `Uzklausa` (
  `id` int(15) NOT NULL,
  `miestas` varchar(20) NOT NULL,
  `kryptis` varchar(15) NOT NULL,
  `vnuo` varchar(10) NOT NULL,
  `viki` varchar(10) NOT NULL,
  `gnuo` varchar(10) NOT NULL,
  `giki` varchar(10) NOT NULL,
  `vardas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ataskaita`
--
ALTER TABLE `Ataskaita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Naujas`
--
ALTER TABLE `Naujas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Oras`
--
ALTER TABLE `Oras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `Uzklausa`
--
ALTER TABLE `Uzklausa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ataskaita`
--
ALTER TABLE `Ataskaita`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Naujas`
--
ALTER TABLE `Naujas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Oras`
--
ALTER TABLE `Oras`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `Uzklausa`
--
ALTER TABLE `Uzklausa`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
