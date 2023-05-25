-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Maio-2023 às 12:58
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `waste_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colector_group`
--

CREATE TABLE `colector_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(300) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `colector_group`
--

INSERT INTO `colector_group` (`id`, `group_name`, `created_by`, `created_at`) VALUES
(1, 'ABC corp', 1, '2022-11-30 00:28:15'),
(3, 'FAAF', 1, '2022-11-30 13:25:25'),
(4, 'Godaddy', 1, '2022-11-30 13:29:45'),
(6, 'LIMPA ANGOLA', 17, '2023-04-24 12:13:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nif` varchar(130) NOT NULL,
  `telefone` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `municipy` varchar(50) NOT NULL,
  `status` varchar(45) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `empresa`, `email`, `nif`, `telefone`, `province`, `municipy`, `status`, `logo`, `password`, `created_by`, `created_at`) VALUES
(4, 'ELISAL', 'nzolakiampava@gmail.com', '899999999', 924598849, 'Luanda', 'Belas', 'aprovado', 'uploads/wastems-388-minfin063684.png', 'c50ccb409aa9230e97c2188c71b9ae2b98e835ba', 17, '2023-05-16 11:17:25'),
(5, 'GUARA', 'delcioferreira57@gmail.com', '999999999', 924947415, 'Luanda', 'Cazenga', 'aprovado', 'uploads/wastems-675-wastems-863-guara-logo-hq.png', '1931c224be879e2773b3fddf699bc786bee5108e', 17, '2023-05-16 12:04:10'),
(6, 'Ecoangola', 'ecoangola@gmail.com', '999999999', 924598849, 'Luanda', 'Cazenga', 'aprovado', 'uploads/wastems-193-EcoAngola-LogoAsset-39-e1564433562227.png', 'f429e1e620fa435c28c2bcd451cfcc53ed94a6a1', 1, '2023-05-17 13:19:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `garbage_address`
--

CREATE TABLE `garbage_address` (
  `id` int(11) NOT NULL,
  `address` varchar(264) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `garbage_address`
--

INSERT INTO `garbage_address` (`id`, `address`, `created_by`, `created_at`) VALUES
(8, '57M8+469, Luanda Rangel KM7 CTT Parque do saber, Luanda', 17, '2023-04-20 11:42:30'),
(3, '56CQ+992, Av. Cmte. Gika, Luanda', 1, '2022-11-30 17:36:53'),
(9, 'Cacuaco, Luanda Angola, Centralidade do Cacuaco, Bloco 2, predio 33', 17, '2023-04-20 11:44:39'),
(10, 'SIAC, 5CX2+2V, Rua Direita do Siac, Cacuaco', 17, '2023-04-20 11:52:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `garbage_cars`
--

CREATE TABLE `garbage_cars` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `registration` varchar(30) NOT NULL,
  `group_id` int(11) NOT NULL,
  `address_id_1` int(11) NOT NULL,
  `address_id_2` int(11) NOT NULL,
  `address_id_3` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `garbage_cars`
--

INSERT INTO `garbage_cars` (`id`, `name`, `registration`, `group_id`, `address_id_1`, `address_id_2`, `address_id_3`, `created_by`, `created_at`) VALUES
(1, 'BMW', '23vfss', 4, 3, 8, 9, 1, '2022-12-05 14:13:38'),
(2, 'Florida', 'MAL45FF', 1, 9, 9, 8, 1, '2022-12-05 14:25:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `history_trashbucket`
--

CREATE TABLE `history_trashbucket` (
  `id` int(11) NOT NULL,
  `trashbucket_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `status_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `province` varchar(50) NOT NULL DEFAULT 'Luanda',
  `municipy` varchar(50) NOT NULL DEFAULT 'Cazenga',
  `address` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `province`, `municipy`, `address`, `message`, `image`, `date`) VALUES
(116, 20, 'Huila', 'Quipungo', 'Nova urbanização', 'zzzzzzzzzzzzzzzz', 'uploads/wastems-767-wastems-699-residuos.jpg', '2023-04-17 13:32:52'),
(115, 1, 'Bie', 'Chitembo', 'Nova urbanização', 'nova vida', 'uploads/wastems-767-wastems-288-lixo.jpeg', '2023-04-15 17:53:01'),
(117, 20, 'Kwanza-Sul', 'Mussende', 'Nova urbanização', 'hgjhgjgj', 'uploads/wastems-363-wastems-767-wastems-699-residuos.jpg', '2023-04-17 13:45:32'),
(119, 17, 'Luanda', 'Cazenga', 'Nova urbanização,cacuaco,luanda,Angola', 'Há muito lixo aqui', 'uploads/wastems-169-18.jpg', '2023-04-24 15:12:08'),
(120, 23, 'Luanda', 'Cacuaco', 'Nova urbanização,cacuaco,luanda,Angola', '', 'uploads/wastems-65-18.jpg', '2023-04-24 15:18:37'),
(121, 17, 'Luanda', 'Cacuaco', 'Nova urbanização,cacuaco,luanda,Angola', '', 'uploads/wastems-909-18.jpg', '2023-05-12 12:00:05'),
(122, 17, 'Luanda', 'Viana', 'Viana,Luanda,Angola', 'veem maze buscar lixo', 'uploads/wastems-137-Garbage-Bin-Prototype.png', '2023-05-12 12:01:37'),
(123, 17, 'Luanda', 'Cazenga', 'Distrito de Rangel, CTT', 'nova vida', 'uploads/wastems-44-images.jpg', '2023-05-12 12:03:02'),
(124, 17, 'Huila', 'Chipindo', 'Nova urbanização', 'mensagem de teste', 'uploads/wastems-810-18.jpg', '2023-05-12 12:26:00'),
(125, 17, 'Huila', 'Chipindo', 'Nova urbanização', 'mensagem de teste', 'uploads/wastems-560-18.jpg', '2023-05-12 12:27:09'),
(126, 17, 'Huila', 'Chipindo', 'Nova urbanização', 'mensagem de teste', 'uploads/wastems-162-18.jpg', '2023-05-12 12:28:22'),
(127, 17, 'Benguela', 'Catumbela', 'chongoroi', 'testando sms e email', 'uploads/wastems-426-Getting-Started-with-ESP32-1.jpg', '2023-05-12 12:35:21'),
(128, 17, 'Benguela', 'Catumbela', 'chongoroi', 'testando sms e email', 'uploads/wastems-380-Getting-Started-with-ESP32-1.jpg', '2023-05-12 12:41:46'),
(129, 17, 'Benguela', 'Catumbela', 'chongoroi', 'testando sms e email', 'uploads/wastems-245-Getting-Started-with-ESP32-1.jpg', '2023-05-12 12:42:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipies`
--

CREATE TABLE `municipies` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `municipy` varchar(30) NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `municipies`
--

INSERT INTO `municipies` (`id`, `parent`, `municipy`, `disabled`) VALUES
(1, 1, 'Luanda', 0),
(2, 1, 'Belas', 0),
(3, 1, 'Cazenga', 0),
(4, 1, 'Viana', 0),
(5, 1, 'Cacuaco', 0),
(6, 1, 'Icolo e Bengo', 0),
(7, 1, 'Quissama', 0),
(8, 2, 'Ambuila', 0),
(9, 2, 'Bembe', 0),
(10, 2, 'Buengas', 0),
(11, 2, 'Bungo', 0),
(12, 2, 'Damba', 0),
(13, 2, 'Alto Cauale', 0),
(14, 2, 'Maquela do Zombo', 0),
(15, 2, 'Milunga', 0),
(16, 3, 'Mucaba', 0),
(17, 3, 'Negage', 0),
(18, 3, 'Puri', 0),
(19, 3, 'Quimbele', 0),
(20, 3, 'Quitexe', 0),
(21, 3, 'Sanza Pombo', 0),
(22, 3, 'Songo', 0),
(23, 3, 'Uige', 0),
(24, 3, 'Ecunha', 0),
(25, 3, 'Caala', 0),
(26, 3, 'Cachiungo', 0),
(27, 3, 'Londuimbale', 0),
(28, 3, 'Longonjo', 0),
(29, 3, 'Mungo', 0),
(30, 3, 'Chicala-Choloanga', 0),
(31, 3, 'Chinjenje', 0),
(32, 3, 'Ucuma', 0),
(33, 4, 'Baia Farta', 0),
(34, 4, 'Balombo', 0),
(35, 4, 'Catumbela', 0),
(36, 4, 'Chongoroi', 0),
(37, 4, 'Cubal', 0),
(38, 4, 'Ganda', 0),
(39, 4, 'Lobito', 0),
(40, 4, 'Caimbambo', 0),
(41, 5, 'Mabanza Congo', 0),
(42, 5, 'Soio', 0),
(43, 5, 'Nezeto', 0),
(44, 5, 'Cuimba', 0),
(45, 5, 'Noqui', 0),
(46, 5, 'Tomboco', 0),
(47, 6, 'Namibe', 0),
(48, 6, 'Bibala', 0),
(49, 6, 'Virei', 0),
(50, 6, 'Camucuio', 0),
(51, 6, 'Tombua', 0),
(52, 7, 'Alto Zambeze', 0),
(53, 7, 'Bundas', 0),
(54, 7, 'Camanongue', 0),
(55, 7, 'Leua', 0),
(56, 7, 'Luacano', 0),
(57, 7, 'Luau', 0),
(58, 7, 'Luchazes', 0),
(59, 7, 'Cameia', 0),
(60, 7, 'Moxico', 0),
(61, 8, 'Cabinda', 0),
(62, 8, 'Cacongo', 0),
(63, 8, 'Buco-Zau', 0),
(64, 8, 'Belize', 0),
(65, 9, 'Cacuso', 0),
(66, 9, 'Calandula', 0),
(67, 9, 'Cambundi Catembo', 0),
(68, 9, 'Cangandala', 0),
(69, 9, 'Caombo', 0),
(70, 9, 'Cuaba Nzoji', 0),
(71, 9, 'Cunda-Dia-Baze', 0),
(72, 9, 'Luquembo', 0),
(73, 9, 'Marimba', 0),
(74, 9, 'Massango', 0),
(75, 9, 'Mucari', 0),
(76, 9, 'Quela', 0),
(77, 9, 'Quirima', 0),
(78, 10, 'Cambulo', 0),
(79, 10, 'Capenda-Camulemba', 0),
(80, 10, 'Caungula', 0),
(81, 10, 'Chitato', 0),
(82, 10, 'Cuango', 0),
(83, 10, 'Cuilo', 0),
(84, 10, 'Dundo', 0),
(85, 10, 'Lubalo', 0),
(86, 10, 'Lucapa', 0),
(87, 10, 'Xa-Muteba', 0),
(88, 11, 'Cacolo', 0),
(89, 11, 'Dala', 0),
(90, 11, 'Muconda', 0),
(91, 11, 'Saurimo', 0),
(92, 12, ' Cahama', 0),
(93, 12, 'Cuanhama', 0),
(94, 12, 'Curoca', 0),
(95, 12, 'Cuvelai', 0),
(96, 12, 'Namacunde', 0),
(97, 12, 'Ombadja', 0),
(98, 13, 'Caconda', 0),
(99, 13, 'Cacula', 0),
(100, 13, 'Caluquembe', 0),
(101, 13, 'Chiange', 0),
(102, 13, 'Chibia', 0),
(103, 13, 'Chicomba', 0),
(104, 13, 'Chipindo', 0),
(105, 13, 'Cuvango', 0),
(106, 13, 'Humpata', 0),
(107, 13, 'Jamba', 0),
(108, 13, 'Lubango', 0),
(109, 13, 'Matala', 0),
(110, 13, 'Quilengues', 0),
(111, 13, 'Quipungo', 0),
(112, 14, 'Ambaca', 0),
(113, 14, 'Banga', 0),
(114, 14, 'Bolongongo', 0),
(115, 14, 'Cambambe', 0),
(116, 14, 'Cazengo', 0),
(117, 14, 'Golungo Alto', 0),
(118, 14, 'Gonguembo', 0),
(119, 14, 'Lucala', 0),
(120, 14, 'Quiculungo', 0),
(121, 14, 'Samba Caju', 0),
(122, 15, 'Amboim', 0),
(123, 15, 'Cassongue', 0),
(124, 15, 'Cela', 0),
(125, 15, 'Conda', 0),
(126, 15, 'Ebo', 0),
(127, 15, 'Libolo', 0),
(128, 15, 'Mussende', 0),
(129, 15, 'Porto Amboim', 0),
(130, 15, 'Quilenda', 0),
(131, 15, 'Quibala', 0),
(132, 15, 'Seles', 0),
(133, 15, 'Sumbe', 0),
(134, 16, 'Andulo', 0),
(135, 16, 'Camacupa', 0),
(136, 16, 'Catabola', 0),
(137, 16, 'Chinguar', 0),
(138, 16, 'Chitembo', 0),
(139, 16, 'Cuemba', 0),
(140, 16, 'Cunhinga', 0),
(141, 16, 'Cuito', 0),
(142, 16, 'Nharea', 0),
(143, 17, 'Ambriz', 0),
(144, 17, 'Bula Atumba', 0),
(145, 17, 'Dande', 0),
(146, 17, 'Dembos', 0),
(147, 17, 'Nambuangongo', 0),
(148, 17, 'Pango Aluquem', 0),
(149, 18, 'Calai', 0),
(150, 18, 'Cuangar', 0),
(151, 18, 'Cuchi', 0),
(152, 18, 'Cuito Cuanavale', 0),
(153, 18, 'Dirico', 0),
(154, 18, 'Mavinga', 0),
(155, 18, 'Menongue', 0),
(156, 18, 'Nancova', 0),
(157, 18, 'Rivungo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `provinces`
--

INSERT INTO `provinces` (`id`, `province`, `disabled`) VALUES
(1, 'Luanda', 0),
(2, 'Uige', 0),
(3, 'Huambo', 0),
(4, 'Benguela', 0),
(5, 'Zaire', 0),
(6, 'Namibe', 0),
(7, 'Moxico', 0),
(8, 'Cabinda', 0),
(9, 'Malanje', 0),
(10, 'Lunda-Norte', 0),
(11, 'Lunda-Sul', 0),
(12, 'Cunene', 0),
(13, 'Huila', 0),
(14, 'Kwanza-Norte', 0),
(15, 'Kwanza-Sul', 0),
(16, 'Bie', 0),
(17, 'Bengo', 0),
(18, 'Cuando-Cubango', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trash_buckets`
--

CREATE TABLE `trash_buckets` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `province` varchar(50) NOT NULL DEFAULT 'Luanda',
  `municipy` varchar(50) NOT NULL DEFAULT 'Cazenga',
  `address_id` int(11) NOT NULL,
  `lat` varchar(30) NOT NULL DEFAULT '-8.839988',
  `lng` varchar(30) NOT NULL DEFAULT '13.289437',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `cm` int(11) NOT NULL DEFAULT 20
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `trash_buckets`
--

INSERT INTO `trash_buckets` (`id`, `name`, `province`, `municipy`, `address_id`, `lat`, `lng`, `created_by`, `created_at`, `status`, `cm`) VALUES
(1, 'ITEL', 'Luanda', 'Cazenga', 8, '-8.839988', '13.289437', 1, '2022-12-01 13:29:01', 'empty', 24),
(4, 'COMICS', 'Uige', 'Bembe', 3, '-8.869988', '13.209434', 1, '2023-01-05 13:30:53', 'middle', 20),
(3, 'Tech', 'Uige', 'Bembe', 3, '-8.879988', '13.269439', 1, '2022-12-01 14:24:05', 'empty', 20),
(5, 'School', 'Uige', 'Bembe', 3, '-8.838988', '13.280435', 1, '2023-01-05 14:08:39', 'full', 20),
(7, 'IMEL', 'Benguela', 'Balombo', 3, '-8.819288', '13.219477', 1, '2023-03-14 13:29:10', 'empty', 20),
(8, 'ISTEM', 'Bie', 'Camacupa', 3, '-8.836988', '13.280431', 1, '2023-03-14 13:29:31', 'full', 20),
(9, 'IMETRO', 'Cabinda', 'Cabinda', 8, '-8.831988', '13.289233', 1, '2023-03-14 13:30:48', 'full', 20),
(10, 'UAN', 'Cuando-Cubango', 'Cuangar', 3, '-8.830088', '13.281167', 1, '2023-03-14 13:32:11', 'empty', 20),
(12, 'UFA', 'Luanda', 'Icolo e Bengo', 3, '-8.832928', '13.288425', 1, '2023-03-14 13:33:01', 'empty', 20),
(17, 'TESTE', 'Luanda', 'Cazenga', 8, '-8.830288', '13.229430', 17, '2023-04-24 12:05:27', 'empty', 20);

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
  `group_id` int(11) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `login_at` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_at` datetime DEFAULT NULL,
  `online` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `rank`, `group_id`, `id_empresa`, `date`, `image`, `created_by`, `login_at`, `logout_at`, `online`) VALUES
(1, 'f6tht64n63p5e10mag5kfoa9889t8p', 'Kiampava', 'nzolakiampava@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Administrador', 0, 0, '2022-11-17 01:45:30', 'uploads/wastems-447-user3-128x128.jpg', 0, '2023-05-19 18:10:29', '2023-04-21 10:14:19', 1),
(3, 'rc77s40mhmbuqg', 'Kiampava', 'kiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-17 23:18:20', 'uploads/wastems-721-user5-128x128.jpg', 0, '2023-04-15 14:45:16', '2023-04-15 14:45:22', 0),
(4, '4cmf0pq3o9b0rtrhl7ss3k28eaah', 'Kira', 'kira@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-25 01:57:11', '', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(5, 'hupd4h0b2q1cc4hcrhlru', 'The Coder', 'thecoder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-25 02:01:02', 'uploads/wastems-735-logo.jpg', 0, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(9, 'k35eenb6nq', 'Wilma', 'wilma@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-25 02:26:41', '', 1, '2022-11-26 20:01:46', '2022-11-26 20:04:06', 0),
(10, '665bjqp3ns64bohnepabn0', 'Emanuel', 'emanuel@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-26 23:47:46', '', 0, '2022-11-26 23:47:46', '2022-11-26 23:49:46', 0),
(11, 'dqg75hb86nad0p2gai0baiqq', 'Helder', 'helder@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-26 23:50:08', '', 0, '2022-11-26 20:50:08', '2022-11-26 20:50:15', 0),
(12, 'jreddu5d3jqf163', 'Mark Zuckerberg', 'mark@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-26 23:52:37', '', 0, '2022-11-26 20:52:37', '2022-11-26 20:52:50', 0),
(13, 'qi21bi86g013bkk1t', 'Prof Valeriano', 'valeriano@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-27 00:03:12', 'uploads/wastems-110-user6-128x128.jpg', 0, '2022-11-27 00:07:34', '2022-11-27 00:03:12', 0),
(14, 'uocdu4t90', 'Delcia Borges', 'nengueborges@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', 0, 0, '2022-11-30 00:07:38', '', 1, '2022-11-29 21:07:39', '0000-00-00 00:00:00', 0),
(15, 'm38q3i1dffg8', 'Mister Flutter', 'misterflutter@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Supervisor', NULL, 0, '2023-02-23 11:14:46', NULL, 1, '2023-04-20 12:39:36', '2023-04-20 16:32:45', 0),
(17, '5d1emf86bl08icf9lbcumrsd', 'Delcio Borges', 'delcioferreira57@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Administrador', NULL, 0, '2023-03-28 13:46:16', NULL, 1, '2023-05-25 11:46:03', '2023-05-16 11:28:13', 1),
(20, '01if205a89dsb04hp6kfmsfu7p', 'Paulo Tumbas', 'paulo@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', NULL, 0, '2023-04-17 09:57:25', 'uploads/wastems-290-57d826c13344eddfec7d31fbe9ba7c38.png', 0, '2023-04-17 09:57:51', '2023-04-17 09:57:25', 1),
(21, '9ns7a2sdn89f9a1g361mfphc3doo60', 'John Doe', 'johndoe@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', 'Normal', NULL, 0, '2023-04-19 11:52:11', NULL, 0, '2023-04-19 11:52:23', '2023-04-19 12:14:50', 0),
(22, 'obi20a6n469', 'Pap', 'pap@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Normal', NULL, 0, '2023-04-24 10:14:45', NULL, 17, '2023-04-24 10:16:13', '2023-04-24 10:19:42', 0),
(23, 'tkikqghktcd1pg57o9', 'Pedro', 'pedrosantos@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Normal', NULL, 0, '2023-04-24 15:15:58', 'uploads/wastems-900-8489d6c9-ccbc-454d-ab09-e74a4b6bac9f.jpg', 0, '2023-04-24 15:16:39', '2023-04-24 15:15:58', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `colector_group`
--
ALTER TABLE `colector_group`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `garbage_address`
--
ALTER TABLE `garbage_address`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `garbage_cars`
--
ALTER TABLE `garbage_cars`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `history_trashbucket`
--
ALTER TABLE `history_trashbucket`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `municipies`
--
ALTER TABLE `municipies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Índices para tabela `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `trash_buckets`
--
ALTER TABLE `trash_buckets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colector_group`
--
ALTER TABLE `colector_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `garbage_address`
--
ALTER TABLE `garbage_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `garbage_cars`
--
ALTER TABLE `garbage_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `history_trashbucket`
--
ALTER TABLE `history_trashbucket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de tabela `municipies`
--
ALTER TABLE `municipies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de tabela `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `trash_buckets`
--
ALTER TABLE `trash_buckets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
