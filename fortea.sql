-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/09/2026 às 04:57
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
  `tipo` varchar(30) NOT NULL DEFAULT 'profissional',
  `item_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `medico_nome` varchar(255) NOT NULL,
  `especialidade` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `usuario_id`, `tipo`, `item_id`, `titulo`, `url`, `medico_nome`, `especialidade`, `criado_em`) VALUES
(0, 4, 'lei', 0, '<br />\r\n<b>Warning</b>:  Undefined variable $lei in <b>C:\\xampp\\htdocs\\TCC-2026\\leis.php</b> on line <b>45</b><br />\r\n<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\\xampp\\htdocs\\TCC-2026\\leis.php</b> on line <b>45</b', 'direitos.php#lei-<br />\r\n<b>Warning</b>:  Undefined variable $lei in <b>C:\\xampp\\htdocs\\TCC-2026\\leis.php</b> on line <b>54</b><br />\r\n<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\\xampp\\htdocs\\TCC-2026\\leis.php</b> on line <b>54</b><br />\r\n0', '', '', '2026-09-22 01:50:08');

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
(0, 0, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-19 00:17:26'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 00:35:45'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 00:38:22'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:08:46'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:10:33'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:11:03'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:12:52'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:13:21'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:14:50'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 01:28:34'),
(0, 4, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-22 02:23:30'),
(0, 5, 0, 0, 'normal', 'nenhum', 1, 1, 1, 0, '2026-09-23 02:48:01');

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
-- Estrutura para tabela `trajetoria_checklists`
--

CREATE TABLE `trajetoria_checklists` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `ordem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trajetoria_checklists`
--

INSERT INTO `trajetoria_checklists` (`id`, `usuario_id`, `titulo`, `descricao`, `icone`, `ordem`) VALUES
(1, 5, 'Antes do diagnóstico', 'Organize informações e prepare-se para as primeiras avaliações.', 'fa-magnifying-glass', 1),
(2, 5, 'Processo de diagnóstico', 'Acompanhe avaliações, consultas e documentos.', 'fa-clipboard-list', 2),
(3, 5, 'Após o diagnóstico', 'Organize os próximos passos e acompanhamentos.', 'fa-heart', 3),
(4, 5, 'Escola e inclusão', 'Acompanhe questões relacionadas à escola e à inclusão.', 'fa-school', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trajetoria_itens`
--

CREATE TABLE `trajetoria_itens` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `etapa` varchar(255) NOT NULL,
  `concluida` tinyint(1) DEFAULT 0,
  `ordem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trajetoria_itens`
--

INSERT INTO `trajetoria_itens` (`id`, `checklist_id`, `etapa`, `concluida`, `ordem`) VALUES
(1, 1, 'Observar e registrar informações importantes do dia a dia', 1, 1),
(2, 1, 'Organizar documentos e informações anteriores', 1, 2),
(3, 1, 'Anotar dúvidas e situações que chamam atenção', 1, 3),
(4, 1, 'Pesquisar sobre o processo de avaliação', 1, 4),
(5, 1, 'Buscar orientação de um profissional', 1, 5),
(6, 2, 'Agendar a avaliação', 1, 1),
(7, 2, 'Organizar documentos para levar às consultas', 1, 2),
(8, 2, 'Registrar consultas e avaliações realizadas', 1, 3),
(9, 2, 'Anotar orientações recebidas', 1, 4),
(10, 2, 'Guardar documentos e relatórios importantes', 1, 5),
(11, 2, 'Registrar dúvidas para os próximos atendimentos', 1, 6),
(12, 3, 'Organizar o diagnóstico e os documentos recebidos', 0, 1),
(13, 3, 'Conhecer as possibilidades de acompanhamento', 0, 2),
(14, 3, 'Registrar profissionais que acompanham a pessoa', 0, 3),
(15, 3, 'Conhecer direitos e possibilidades de apoio', 0, 4),
(16, 3, 'Organizar informações importantes para a família', 0, 5),
(17, 3, 'Manter os registros atualizados', 0, 6),
(18, 4, 'Conversar com a escola sobre as necessidades', 0, 1),
(19, 4, 'Registrar reuniões e orientações', 0, 2),
(20, 4, 'Compartilhar informações importantes com a equipe escolar', 0, 3),
(21, 4, 'Acompanhar adaptações e estratégias utilizadas', 0, 4),
(22, 4, 'Registrar mudanças importantes na rotina escolar', 0, 5),
(23, 4, 'Manter comunicação com a escola', 0, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trajetoria_registros`
--

CREATE TABLE `trajetoria_registros` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_registro` date NOT NULL,
  `profissional` varchar(150) DEFAULT NULL,
  `local` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'ISADORA RIBEIRO JANS', 'isadoraribeiro2708@gmail.com', '$2y$10$TOhFaTl7TtGcFOincqvaOOurWp9CEOm2dRB9yodNT/lWFQxDldDYC', '2026-09-19 00:14:18', NULL),
(2, 'isadora', 'isadora@gmail.com', '$2y$10$x0juacZNT1NxUDSA32LQYeeFPA1f3cr184mkd1aqEkXyKTyN97ee2', '2026-09-21 23:45:12', NULL),
(3, 'isadora', 'isaa@gmail.com', '$2y$10$vuMNRI4VJg0wzpaBGV7JveNCSzPFlBVF31BNwa7zUr9e0mIreAPxO', '2026-09-22 00:01:19', NULL),
(4, 'isa jans', 'isa@gmail.com', '$2y$10$lJsGC4LkhVzjqKSZFwpTme4guEdClkdty/MaTwAzC/yGJYc0xXlcK', '2026-09-22 00:09:46', NULL),
(5, 'Heloisa', 'heloisa@gmail.com', '$2y$10$c/iV2uTwZ3wiZ.A3Enour.dklHtvncBfO6xft1o/.QUuPZ.mQ0IKu', '2026-09-23 02:09:25', 'uploads/perfis/perfil_5_1790131747.jpg'),
(6, 'Heloisa Rodrigues', 'heloisalinda@gmail.com', '$2y$10$Q1aOlVt2uVSW9Rx0gahfgO07woW/07GQx.3PwkiZ4ioAXZddC41My', '2026-09-23 02:19:11', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD KEY `idx_favoritos_usuario_tipo` (`usuario_id`,`tipo`),
  ADD KEY `idx_favoritos_item` (`item_id`);

--
-- Índices de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `trajetoria_checklists`
--
ALTER TABLE `trajetoria_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `trajetoria_itens`
--
ALTER TABLE `trajetoria_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Índices de tabela `trajetoria_registros`
--
ALTER TABLE `trajetoria_registros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `trajetoria_checklists`
--
ALTER TABLE `trajetoria_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `trajetoria_itens`
--
ALTER TABLE `trajetoria_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `trajetoria_registros`
--
ALTER TABLE `trajetoria_registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `trajetoria_checklists`
--
ALTER TABLE `trajetoria_checklists`
  ADD CONSTRAINT `trajetoria_checklists_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `trajetoria_itens`
--
ALTER TABLE `trajetoria_itens`
  ADD CONSTRAINT `trajetoria_itens_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `trajetoria_checklists` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `trajetoria_registros`
--
ALTER TABLE `trajetoria_registros`
  ADD CONSTRAINT `trajetoria_registros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
