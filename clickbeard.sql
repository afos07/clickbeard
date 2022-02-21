-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/02/2022 às 20:54
-- Versão do servidor: 10.4.20-MariaDB
-- Versão do PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clickbeard`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agendamento` int(11) NOT NULL,
  `usuario_id_agendamento` int(11) NOT NULL,
  `barbeiros_id_agendamento` int(11) NOT NULL,
  `especialidade_agendamento` varchar(100) NOT NULL,
  `data_agendamento` datetime NOT NULL,
  `status_agendamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `barbeiros`
--

CREATE TABLE `barbeiros` (
  `id_barbeiro` int(11) NOT NULL,
  `nome_barbeiro` varchar(100) NOT NULL,
  `idade_barbeiro` int(11) NOT NULL,
  `data_contratacao_barbeiro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `barbeiros_especialidades`
--

CREATE TABLE `barbeiros_especialidades` (
  `id_especialidade` int(11) NOT NULL,
  `barbeiro_id_especialidade` int(11) NOT NULL,
  `desc_especialidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id_admin` int(11) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `nome_admin` varchar(100) NOT NULL,
  `senha_admin` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id_admin`, `email_admin`, `nome_admin`, `senha_admin`) VALUES
(1, 'admin@email.com', 'ADMIN', '$2y$10$/My5Xxxprl9tjU73xtXrQO/nfare4mt3wDog5RnD/EXzpM9ITS.ze');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agendamento`);

--
-- Índices de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  ADD PRIMARY KEY (`id_barbeiro`);

--
-- Índices de tabela `barbeiros_especialidades`
--
ALTER TABLE `barbeiros_especialidades`
  ADD PRIMARY KEY (`id_especialidade`),
  ADD KEY `fk` (`barbeiro_id_especialidade`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  MODIFY `id_barbeiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `barbeiros_especialidades`
--
ALTER TABLE `barbeiros_especialidades`
  MODIFY `id_especialidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `barbeiros_especialidades`
--
ALTER TABLE `barbeiros_especialidades`
  ADD CONSTRAINT `relacionamento` FOREIGN KEY (`barbeiro_id_especialidade`) REFERENCES `barbeiros` (`id_barbeiro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
