-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2020 às 14:00
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `email`, `categoria`) VALUES
(1, 'Jorge da Silva', 'jorge@terra.com.br', '1'),
(2, 'Flavia Monteiro', 'flavia@globo.com', '2'),
(3, 'Marcos Frota Ribeiro', 'ribeiro@gmail.com', '2'),
(4, 'Raphael Souza Santos', 'rsantos@gmail.com', '1'),
(5, 'Pedro Paulo Mota', 'ppmota@gmail.com', '1'),
(6, 'Winder Carvalho da Silva', 'winder@hotmail.com', '3'),
(7, 'Maria da Penha Albuquerque', 'mpa@hotmail.com', '3'),
(8, 'Rafael Garcia Souza', 'rgsouza@hotmail.com', '3'),
(9, 'Tabata Costa', 'tabata_costa@gmail.com', '2'),
(10, 'Ronil Camarote', 'camarote@terra.com.br', '1'),
(11, 'Joaquim Barbosa', 'barbosa@globo.com', '1'),
(12, 'Eveline Maria Alcantra', 'ev_alcantra@gmail.com', '2'),
(13, 'João Paulo Vieira', 'jpvieria@gmail.com', '1'),
(14, 'Carla Zamborlini', 'zamborlini@terra.com.br', '3');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
