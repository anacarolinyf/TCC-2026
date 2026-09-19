-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/09/2026 às 03:07
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
(1, 1, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-09 16:15:26'),
(0, 0, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-19 00:17:26');

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
-- Estrutura para tabela `recuperacao_senha`
--

CREATE TABLE `recuperacao_senha` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `codigo_hash` varchar(255) NOT NULL,
  `expira_em` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT 0,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `recuperacao_senha`
--

INSERT INTO `recuperacao_senha` (`id`, `usuario_id`, `codigo_hash`, `expira_em`, `usado`, `criado_em`) VALUES
(1, 0, '$2y$10$QWSCxA59A957NYtYfx.VpuWCJN8ElePbM9K9bsFusagu1C4ec1Q6S', '2026-09-19 02:59:29', 1, '2026-09-18 21:49:29'),
(2, 0, '$2y$10$YgUSLtWBuI89G3p5Gr9yBeWu9l0SffRg1AfWm9y1Wu2pGzpX1JHbm', '2026-09-19 02:59:51', 1, '2026-09-18 21:49:51'),
(3, 0, '$2y$10$EZ8S1AFapGGjwMKAgezrteewboDqCApaWUVyYL8upaSI/eUu0wx3W', '2026-09-19 03:01:22', 1, '2026-09-18 21:51:22'),
(4, 0, '$2y$10$q4IfJqMsnStAwiqCbl52DOx7VNdXVIO4iHt8OkNhZPLveRXNRzpjC', '2026-09-19 03:01:29', 0, '2026-09-18 21:51:29');

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
(0, 'ISADORA RIBEIRO JANS', 'isadoraribeiro2708@gmail.com', '$2y$10$TOhFaTl7TtGcFOincqvaOOurWp9CEOm2dRB9yodNT/lWFQxDldDYC', '2026-09-19 00:14:18', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
