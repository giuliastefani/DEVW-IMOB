-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/12/2025 às 20:25
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devw-imob`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `cpf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_ibfk_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `usuario_id`, `cpf`, `data_nascimento`, `created_at`, `updated_at`) VALUES
(1, 'Giulia Santos Stefani', 2, '45491314897', '2001-11-14', '2025-12-03 15:20:16', '2025-12-03 15:20:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imovel`
--

DROP TABLE IF EXISTS `imovel`;
CREATE TABLE IF NOT EXISTS `imovel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `tipo_imovel` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantidade_quartos` int NOT NULL,
  `quantidade_banheiros` int NOT NULL,
  `metros_quadrados` int NOT NULL,
  `tipo_transacao` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `imovel`
--

INSERT INTO `imovel` (`id`, `cidade`, `bairro`, `rua`, `numero`, `tipo_imovel`, `quantidade_quartos`, `quantidade_banheiros`, `metros_quadrados`, `tipo_transacao`) VALUES
(1, 'Rafard', 'Centro', 'Rua Capitão José Duarte Nunes', '65', 'Casa', 3, 2, 300, 'Aluguel'),
(2, 'Capivari', 'Centro', 'Padre Fabiano', '1162', 'Casa', 4, 2, 250, 'Venda'),
(3, 'Rafard', 'Centro', 'Jose de Moraes Barros', '134', 'Casa', 2, 1, 150, 'Venda');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil` varchar(50) NOT NULL DEFAULT 'usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `perfil`) VALUES
(1, 'admin', 'admin', '$2y$10$GjJwRZgjDYb0tfYtWKJ8uumuk8WGMsC1fMQ1GZLT/WpyMFug4uoku', 'admin'),
(2, 'giulia stefani', 'giulia', '$2y$10$1qlCuIDVi5D4Jv1slLjL8.yPpmvwKaLhPC0ZjTMF94e8BHHUGoqhO', 'usuario');

--
-- Acionadores `usuario`
--
DROP TRIGGER IF EXISTS `usuario_create_cliente`;
DELIMITER $$
CREATE TRIGGER `usuario_create_cliente` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
                IF NEW.perfil = 'usuario' THEN
                    INSERT INTO cliente (nome, cpf, data_nascimento, usuario_id, created_at, updated_at)
                    VALUES (NEW.nome, '', NULL, NEW.id, NOW(), NOW());
                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `visita`
--

DROP TABLE IF EXISTS `visita`;
CREATE TABLE IF NOT EXISTS `visita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_imovel` int NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_imovel` (`id_imovel`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
