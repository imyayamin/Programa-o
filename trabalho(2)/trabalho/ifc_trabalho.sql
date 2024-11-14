-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04/10/2024 às 11:16
-- Versão do servidor: 8.2.0
-- Versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifc_trabalho`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `sobrenome_cliente` varchar(45) DEFAULT NULL,
  `cpf_cliente` varchar(45) DEFAULT NULL,
  `fone_cliente` varchar(45) DEFAULT NULL,
  `whats_cliente` varchar(45) DEFAULT NULL,
  `email_cliente` varchar(45) DEFAULT NULL,
  `cliente_senha` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `sobrenome_cliente`, `cpf_cliente`, `fone_cliente`, `whats_cliente`, `email_cliente`, `cliente_senha`, `data_cadastro`) VALUES
(1, 'Wellington', 'Oliveira', '0501111111111', '47999132222', '47999222552', 'teste@teste.com', 'MTEx', '2024-09-23 11:39:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `img_produto` varchar(45) DEFAULT NULL,
  `nome_produto` varchar(450) DEFAULT NULL,
  `preco_produto` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `img_produto`, `nome_produto`, `preco_produto`) VALUES
(1, 'img_sorteio11.jpeg', NULL, NULL),
(2, 'img_sorteio11.jpeg', 'Produto teste 2', 15.99);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
