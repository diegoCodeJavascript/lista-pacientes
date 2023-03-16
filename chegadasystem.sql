-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Mar-2023 às 11:36
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chegadasystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chegadac`
--

CREATE TABLE `chegadac` (
  `icdc` int(88) NOT NULL,
  `paciente` varchar(999) NOT NULL,
  `prontuario` varchar(555) NOT NULL,
  `chegadahora` varchar(555) NOT NULL,
  `data` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `coduser` int(89) NOT NULL,
  `cpf` varchar(999) NOT NULL,
  `senha` varchar(1500) NOT NULL,
  `nome` varchar(299) NOT NULL,
  `sobrenome` varchar(299) NOT NULL,
  `email` varchar(999) NOT NULL,
  `statusac` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`coduser`, `cpf`, `senha`, `nome`, `sobrenome`, `email`, `statusac`) VALUES
(1, 'MDAwLjAwMC4wMDAtMDA=', 'MTIzNDU=', 'DIEGO', 'TESTE SOFTWARE', 'dGVzdGVAZGllZ28=', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `idr` int(88) NOT NULL,
  `nome` varchar(1000) NOT NULL,
  `datanas` varchar(500) NOT NULL,
  `prontuario` varchar(100) NOT NULL,
  `cartaosus` varchar(999) NOT NULL,
  `cartaoconvenio` varchar(999) DEFAULT NULL,
  `celularp` varchar(500) DEFAULT NULL,
  `cep` varchar(500) DEFAULT NULL,
  `rua` varchar(1000) DEFAULT NULL,
  `bairro` varchar(1000) DEFAULT NULL,
  `cidade` varchar(1000) DEFAULT NULL,
  `estado` varchar(355) DEFAULT NULL,
  `numerocs` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chegadac`
--
ALTER TABLE `chegadac`
  ADD PRIMARY KEY (`icdc`);

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`coduser`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`idr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chegadac`
--
ALTER TABLE `chegadac`
  MODIFY `icdc` int(88) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `coduser` int(89) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `idr` int(88) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
