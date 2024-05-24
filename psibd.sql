-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24-Maio-2024 às 16:02
-- Versão do servidor: 8.0.28
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `psibd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhocompras`
--

CREATE TABLE `carrinhocompras` (
  `IDCC` int NOT NULL,
  `IDUser` int NOT NULL,
  `Estado` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenscc`
--

CREATE TABLE `itenscc` (
  `IDProduto` int NOT NULL,
  `IDcc` int NOT NULL,
  `Quantidade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `IDProduto` int NOT NULL,
  `Nome` int NOT NULL,
  `Imagem` int NOT NULL,
  `PrecoUnitario` int NOT NULL,
  `Descrição` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IDUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `IDUser`) VALUES
('afonsor', 'afonsor@lh.com', '$2y$10$C/3AGRvc6MBIC3ES090uvuN9rA33GnQy8Ohjk.y/G6q6ofMi6ZkC2', 1),
('daniel', 'daniel@localhost.com', '123', 2),
('xavier', 'xavier@lh.com', '321', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinhocompras`
--
ALTER TABLE `carrinhocompras`
  ADD PRIMARY KEY (`IDCC`),
  ADD KEY `FKUSER` (`IDUser`);

--
-- Índices para tabela `itenscc`
--
ALTER TABLE `itenscc`
  ADD PRIMARY KEY (`IDProduto`,`IDcc`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`IDProduto`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IDUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `IDUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinhocompras`
--
ALTER TABLE `carrinhocompras`
  ADD CONSTRAINT `FKUSER` FOREIGN KEY (`IDUser`) REFERENCES `user` (`IDUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`IDProduto`) REFERENCES `itenscc` (`IDProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
