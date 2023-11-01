-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/11/2023 às 00:48
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_login`
--

CREATE TABLE `cadastro_login` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_login`
--

INSERT INTO `cadastro_login` (`id`, `fullname`, `username`, `email`, `password`) VALUES
(1, 'Emanuelle Camilly', 'manucamillyy', 'manubento1907@gmail.com', '$2y$10$zfhSkC3AnfUjQLSL7wrnAuG.HvcW03Ey2HqbIVnVqLQEWg733T3ji'),
(2, 'Caroline Aparecida Bento', 'caca', 'carolbento2829@gmail.com', '$2y$10$iveVTZVGFZKFudo886ySKeCzD030fs5CG3nd/lhJlbce324kY2uPi'),
(3, 'thiagomiguelbentodelima', 'tmbl2000', 'thiagomiguelbento@gmail.com', '$2y$10$MCUx9kjOsScQA.xA6YVlO.RTPE1GU3.a4wVhY8beaYznBpCmq3lCm'),
(4, 'laura alves oliveira', 'lau.alves', 'lauraalvesoliveira409@gmail.com', '$2y$10$ENovJlbcVByUt.LxrEMKV.vZSUv5iXwq9HWJcUFxrx4VF9vgq2k3O'),
(5, 'Fernanda leonarda de carvalho ', 'ferleonarda22', 'fernandaleonarda.22@gmail.com', '$2y$10$18e5SYTuYuw6HzFCQukkFOPjXWGxULnATChlefo4a5l2KFoImg74a'),
(6, ' Mariana da Silveira', 'Marii_silveira', 'marianasilveira5533@gmail.com', '$2y$10$1uJ2EqpMwI80rS98u.0xRerCIvDogk.0h7x67.JUZJ76vMRGyobsy'),
(7, 'Anna Carolina Moreira Esteves', 'annalinaes', 'annalinaes602@gmail.com', '$2y$10$jSGKkI081IGIeQNNEFWQfu3NYvB584TdsUcqrb0wtsrv1ZRreYdGi'),
(9, 'alexsandra kamyle ferreira dos santos', 'alexsandra', 'ale@gamil.com', '$2y$10$9EkbMzDrNMTL37DJ3wJbo.UR44zhAkcHaZhY9Icd5vD5FnXcRnkp2');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_login`
--
ALTER TABLE `cadastro_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_login`
--
ALTER TABLE `cadastro_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
