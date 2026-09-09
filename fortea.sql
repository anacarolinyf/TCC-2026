-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2026 às 18:16
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
-- Banco de dados: `fortea`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `chave` varchar(100) NOT NULL,
  `valor` text DEFAULT NULL,
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`, `atualizado_em`) VALUES
(1, 'nome_site', '', '2026-08-17 01:08:08'),
(2, 'descricao_site', '', '2026-08-17 01:08:08'),
(3, 'email_contato', '', '2026-08-14 17:17:25'),
(4, 'telefone', '', '2026-08-14 17:17:25'),
(5, 'endereco', '', '2026-08-14 17:17:25'),
(6, 'instagram', '', '2026-08-14 17:17:25'),
(7, 'facebook', '', '2026-08-14 17:17:25'),
(8, 'youtube', '', '2026-08-14 17:17:25'),
(9, 'linkedin', '', '2026-08-14 17:17:25'),
(10, 'cor_principal', '#2454A6', '2026-08-17 01:08:19'),
(11, 'cor_secundaria', '#193F80', '2026-08-17 01:08:19'),
(12, 'meta_title', '', '2026-08-14 17:17:25'),
(13, 'meta_description', '', '2026-08-14 17:17:25'),
(14, 'modo_escuro', '0', '2026-08-15 03:32:13'),
(15, 'alto_contraste', '0', '2026-08-15 03:32:13'),
(16, 'reduzir_animacoes', '0', '2026-08-15 03:32:13'),
(17, 'tamanho_fonte', 'normal', '2026-08-15 03:32:13'),
(18, 'notificacoes_sistema', '1', '2026-08-15 03:32:13'),
(19, 'lembretes', '1', '2026-08-15 03:32:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos_medicos`
--

CREATE TABLE `contatos_medicos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `medico_nome` varchar(255) NOT NULL,
  `especialidade` varchar(255) DEFAULT NULL,
  `ultima_conversa` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `medico_nome` varchar(255) NOT NULL,
  `especialidade` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preferencias_usuario`
--

CREATE TABLE `preferencias_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modo_escuro` tinyint(1) NOT NULL DEFAULT 0,
  `reduzir_animacoes` tinyint(1) NOT NULL DEFAULT 0,
  `tamanho_fonte` enum('pequena','normal','grande','muito_grande') NOT NULL DEFAULT 'normal',
  `daltonismo` enum('nenhum','protanopia','deuteranopia','tritanopia','acromatopsia') NOT NULL DEFAULT 'nenhum',
  `notificacoes_sistema` tinyint(1) NOT NULL DEFAULT 1,
  `notificacoes_lembretes` tinyint(1) NOT NULL DEFAULT 1,
  `notificacoes_novidades` tinyint(1) NOT NULL DEFAULT 1,
  `notificacoes_navegador` tinyint(1) NOT NULL DEFAULT 0,
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `preferencias_usuario`
--

INSERT INTO `preferencias_usuario` (`id`, `usuario_id`, `modo_escuro`, `reduzir_animacoes`, `tamanho_fonte`, `daltonismo`, `notificacoes_sistema`, `notificacoes_lembretes`, `notificacoes_novidades`, `notificacoes_navegador`, `atualizado_em`) VALUES
(1, 1, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-09 16:15:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionais`
--

CREATE TABLE `profissionais` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `especialidade` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profissionais`
--

INSERT INTO `profissionais` (`id`, `nome`, `especialidade`, `descricao`, `telefone`, `whatsapp`, `foto`, `ativo`) VALUES
(1, 'Dra. Raphaella Gomes', 'Psicóloga', 'Psicóloga especializada no atendimento de pessoas com Transtorno do Espectro Autista (TEA).', '(11) 99999-1111', '5511999991111', 'uploads/profissionais/raphaella-gomes.png', 1),
(2, 'Dr. Alexandre Nascimento', 'Fonoaudiólogo', 'Fonoaudiólogo especializado em comunicação e desenvolvimento de pessoas com TEA.', '(11) 98888-2222', '5511988882222', 'uploads/profissionais/alexandre-nascimento.png', 1),
(3, 'Dra. Gabriella Oliveira', 'Terapeuta Ocupacional', 'Terapeuta ocupacional com experiência em desenvolvimento da autonomia e habilidades sociais.', '(11) 97777-3333', '5511977773333', 'uploads/profissionais/gabriella-oliveira.png', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `foto`) VALUES
(1, 'Isadora Ribeiro Jans', 'isadoraribeiro2708@gmail.com', '$2y$10$XheseoIDhwIf9gaNNsHqeuNANUArTvj9ZM39J7oC9zUU/JAtzecs.', '2026-08-14 00:45:39', 'uploads/perfis/perfil_1_1787016896.jpg'),
(2, 'heloisa lima', 'heloisa123@gmail.com', '$2y$10$kYmEqryTDjLpCg026aYHA.3s7k9VT6S1s0KhdvVjTUrdvQ7b1DXZW', '2026-08-14 01:11:35', NULL),
(3, 'Alex Jans', 'alex.jans2015@gmsil.com', '$2y$10$o1LjUAzFSCw11DiCyf2wNOyIzoB.QJJEedCGYCf14IExKQJ7SWF6a', '2026-08-14 01:15:27', NULL),
(4, 'Isabella', 'isabellajans.2021@gmail.com', '$2y$10$is98987DZCmh1MobF09VQOc7TMKBP4uK88OMdgLWmHGGGUtHCy3Ra', '2026-08-14 01:22:34', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chave` (`chave`);

--
-- Índices de tabela `contatos_medicos`
--
ALTER TABLE `contatos_medicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `preferencias_usuario`
--
ALTER TABLE `preferencias_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `profissionais`
--
ALTER TABLE `profissionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `contatos_medicos`
--
ALTER TABLE `contatos_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preferencias_usuario`
--
ALTER TABLE `preferencias_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `profissionais`
--
ALTER TABLE `profissionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
