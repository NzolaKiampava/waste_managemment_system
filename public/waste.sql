-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Jan-2023 às 08:52
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `waste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colector_group`
--

DROP TABLE IF EXISTS `colector_group`;
CREATE TABLE IF NOT EXISTS `colector_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(300) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `colector_group`
--

INSERT INTO `colector_group` (`id`, `group_name`, `created_by`, `created_at`) VALUES
(1, 'ABC corp', 1, '2022-11-30 00:28:15'),
(3, 'FAAF', 1, '2022-11-30 13:25:25'),
(4, 'Godaddy', 1, '2022-11-30 13:29:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `garbage_address`
--

DROP TABLE IF EXISTS `garbage_address`;
CREATE TABLE IF NOT EXISTS `garbage_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(264) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `garbage_address`
--

INSERT INTO `garbage_address` (`id`, `address`, `created_by`, `created_at`) VALUES
(1, 'Luanda', 1, '2022-11-30 00:28:15'),
(3, '56CQ+992, Av. Cmte. Gika, Luanda', 1, '2022-11-30 17:36:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `garbage_cars`
--

DROP TABLE IF EXISTS `garbage_cars`;
CREATE TABLE IF NOT EXISTS `garbage_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `registration` varchar(30) NOT NULL,
  `group_id` int(11) NOT NULL,
  `address_id_1` int(11) NOT NULL,
  `address_id_2` int(11) NOT NULL,
  `address_id_3` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `garbage_cars`
--

INSERT INTO `garbage_cars` (`id`, `name`, `registration`, `group_id`, `address_id_1`, `address_id_2`, `address_id_3`, `created_by`, `created_at`) VALUES
(1, 'BMW', '23vfss', 4, 1, 3, 1, 1, '2022-12-05 14:13:38'),
(2, 'Florida', 'MAL45FF', 1, 1, 3, 3, 1, '2022-12-05 14:25:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_name` varchar(60) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `message` text,
  `image` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `sender_name`, `address`, `message`, `image`, `date`) VALUES
(1, 'Nzola Kiampava', 'Luanda, Angola', 'Aqui tem muito lixo senhores, fazem alguma coisa pÃ¡', 'uploads/wastems-288-lixo.jpeg', '2023-01-10 17:11:05'),
(2, 'Itel Social', 'CTT Cazenga, wakanda space', 'Aqui tem um contentor cheio de lixo, por favor vem tirar essa brincadeira', 'uploads/wastems-699-residuos.jpg', '2023-01-17 10:28:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trash_buckets`
--

DROP TABLE IF EXISTS `trash_buckets`;
CREATE TABLE IF NOT EXISTS `trash_buckets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `trash_buckets`
--

INSERT INTO `trash_buckets` (`id`, `name`, `address_id`, `created_by`, `created_at`, `status`) VALUES
(1, 'ITEL', 1, 1, '2022-12-01 13:29:01', 'full'),
(4, 'COMICS', 1, 1, '2023-01-05 13:30:53', 'empty'),
(3, 'Tech', 3, 1, '2022-12-01 14:24:05', 'empty'),
(5, 'School', 1, 1, '2023-01-05 14:08:39', 'empty');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_address` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `login_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_at` datetime DEFAULT NULL,
  `online` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `rank`, `group_id`, `date`, `image`, `created_by`, `login_at`, `logout_at`, `online`) VALUES
(1, 'f6tht64n63p5e10mag5kfoa9889t8p', 'Kiampava', 'nzolakiampava@gmail.com', '34e45d8617c5201f77d1b00ce580b601148d24c5', 'Administrador', 0, '2022-11-17 01:45:30', 'uploads/wastems-447-user3-128x128.jpg', 0, '2023-01-05 13:05:43', '2023-01-05 13:04:13', 1),
(2, 'linttoq245519r2jcl4jf', 'delcio', 'delcio@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Administrador', 0, '2022-11-17 23:15:36', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(3, 'rc77s40mhmbuqg', 'Kiampava', 'kiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-17 23:18:20', 'uploads/wastems-721-user5-128x128.jpg', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(4, '4cmf0pq3o9b0rtrhl7ss3k28eaah', 'Kira', 'kira@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-25 01:57:11', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(5, 'hupd4h0b2q1cc4hcrhlru', 'The Coder', 'thecoder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-25 02:01:02', 'uploads/wastems-735-logo.jpg', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(9, 'k35eenb6nq', 'Wilma', 'wilma@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-25 02:26:41', '', 1, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(10, '665bjqp3ns64bohnepabn0', 'Emanuel', 'emanuel@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-26 23:47:46', '', 0, '2022-11-26 23:47:46', '2022-11-26 23:49:46', 0),
(11, 'dqg75hb86nad0p2gai0baiqq', 'Helder', 'helder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-26 23:50:08', '', 0, '2022-11-26 20:50:08', '2022-11-26 20:50:15', 0),
(12, 'jreddu5d3jqf163', 'Mark Zuckerberg', 'mark@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-26 23:52:37', '', 0, '2022-11-26 20:52:37', '2022-11-26 20:52:50', 0),
(13, 'qi21bi86g013bkk1t', 'Prof Valeriano', 'valeriano@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-27 00:03:12', 'uploads/wastems-110-user6-128x128.jpg', 0, '2022-11-27 00:07:34', '2022-11-27 00:03:12', 0),
(14, 'uocdu4t90', 'Delcia Borges', 'nengueborges@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, '2022-11-30 00:07:38', '', 1, '2022-11-29 21:07:39', '0000-00-00 00:00:00', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
