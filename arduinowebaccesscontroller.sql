-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Mar-2019 às 02:34
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arduinowebaccesscontroller`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `tagRFID` varchar(20) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  `idSetor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL,
  `idSetor` int(11) NOT NULL,
  `Sigla` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id`, `idSetor`, `Sigla`) VALUES
(1, 1012, 'NCF - Núcleo de Controle e Fiscalização');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setorusuario`
--

CREATE TABLE `setorusuario` (
  `id` int(11) NOT NULL,
  `CPF` varchar(11) COLLATE utf8_bin NOT NULL,
  `idSetor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `setorusuario`
--

INSERT INTO `setorusuario` (`id`, `CPF`, `idSetor`) VALUES
(1, '11111111111', 1012);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `CPF` varchar(11) COLLATE utf8_bin NOT NULL,
  `dataDeNascimento` date NOT NULL,
  `tipoConta` enum('func','adm','user') COLLATE utf8_bin NOT NULL,
  `status` varchar(20) COLLATE utf8_bin NOT NULL,
  `tagRFID` varchar(128) COLLATE utf8_bin NOT NULL,
  `biometria` blob NOT NULL,
  `senha` varchar(128) COLLATE utf8_bin NOT NULL,
  `senha4` varchar(128) COLLATE utf8_bin NOT NULL,
  `cargo` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `CPF`, `dataDeNascimento`, `tipoConta`, `status`, `tagRFID`, `biometria`, `senha`, `senha4`, `cargo`) VALUES
(1, 'Leonardo Henrique', '11111111111', '1993-09-14', 'adm', 'Ativo', '732e4861d97b4fcfeda4d7e12e6d4b8565ed78cbed1dc2d47aa4a326dff69c2eb66f40b6f874d757ba77f499883cb99dd36508c39e2a7f3f3dea333a4f2b7ac9', '', 'bf16fadfbdf1f8450d143857c08a8acb70033cc48d18b22037e18a8ca7081f636a0b805e5241e5e30959a21ee773c3293251a34923a8e77925dd140116f25293', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'Gerente'),
(2, 'José Bonifácio', '22222222222', '1994-07-14', 'func', 'Ativo', 'aaa', '', 'bf16fadfbdf1f8450d143857c08a8acb70033cc48d18b22037e18a8ca7081f636a0b805e5241e5e30959a21ee773c3293251a34923a8e77925dd140116f25293', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setorusuario`
--
ALTER TABLE `setorusuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setorusuario`
--
ALTER TABLE `setorusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
