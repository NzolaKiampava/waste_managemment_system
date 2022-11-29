-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2022 às 02:40
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.25

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
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `login_at` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_at` datetime NOT NULL,
  `online` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `rank`, `date`, `image`, `created_by`, `login_at`, `logout_at`, `online`) VALUES
(1, 'f6tht64n63p5e10mag5kfoa9889t8p', 'Kiampava', 'nzolakiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Administrador', '2022-11-17 01:45:30', 'uploads/wastems-447-user3-128x128.jpg', 0, '2022-11-28 00:37:03', '2022-11-27 23:01:00', 1),
(2, 'linttoq245519r2jcl4jf', 'delcio', 'delcio@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Administrador', '2022-11-17 23:15:36', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(3, 'rc77s40mhmbuqg', 'Kiampava', 'kiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-17 23:18:20', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(4, '4cmf0pq3o9b0rtrhl7ss3k28eaah', 'Kira', 'kira@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-25 01:57:11', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(5, 'hupd4h0b2q1cc4hcrhlru', 'The Coder', 'thecoder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-25 02:01:02', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(9, 'k35eenb6nq', 'Wilma', 'wilma@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-25 02:26:41', '', 1, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(10, '665bjqp3ns64bohnepabn0', 'Emanuel', 'emanuel@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-26 23:47:46', '', 0, '2022-11-26 23:47:46', '2022-11-26 23:49:46', 0),
(11, 'dqg75hb86nad0p2gai0baiqq', 'Helder', 'helder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-26 23:50:08', '', 0, '2022-11-26 20:50:08', '2022-11-26 20:50:15', 0),
(12, 'jreddu5d3jqf163', 'Mark Zuckerberg', 'mark@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-26 23:52:37', '', 0, '2022-11-26 20:52:37', '2022-11-26 20:52:50', 0),
(13, 'qi21bi86g013bkk1t', 'Prof Valeriano', 'valeriano@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', '2022-11-27 00:03:12', '', 0, '2022-11-27 00:07:34', '2022-11-27 00:03:12', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
