-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2018 às 02:22
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cash_advance`
--
CREATE DATABASE IF NOT EXISTS `cash_advance` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cash_advance`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `checks`
--

DROP TABLE IF EXISTS `checks`;
CREATE TABLE `checks` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` double NOT NULL,
  `number` varchar(255) NOT NULL,
  `proa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `proas`
--

DROP TABLE IF EXISTS `proas`;
CREATE TABLE `proas` (
  `id` int(11) NOT NULL,
  `proa` varchar(255) NOT NULL,
  `proa_pct` varchar(255) DEFAULT NULL,
  `total_value` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `pct_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `rubric_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rubrics`
--

DROP TABLE IF EXISTS `rubrics`;
CREATE TABLE `rubrics` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `token` text,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `enabled`, `token`, `token_expiration`) VALUES
(1, 'Admin', 'admin@email.com', '$2a$10$NJmJOsRmcgUqZeab6GlUgOaVc6hHNvIbD2CykEIn0WtjADebSQe7W', 'admin', 1, NULL, NULL),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proas`
--
ALTER TABLE `proas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubrics`
--
ALTER TABLE `rubrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `proas`
--
ALTER TABLE `proas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `rubrics`
--
ALTER TABLE `rubrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
