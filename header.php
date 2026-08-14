<?php
session_start();

$nomeUsuario = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ForTEA</title>
    <link rel="icon" type="image" href="img/logoo.png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header>

    <div class="topo">

        <div class="logo">
            <img src="img/logoo.png" alt="Logo">
            <h2>ForTEA</h2>
        </div>

        <div class="acoes">

            <div class="pesquisa">
                <input type="text" placeholder="O que você procura?">
            </div>

            <?php if ($nomeUsuario): ?>

                <a href="perfil.php" class="usuario-logado">
                    <i class="fa-regular fa-user"></i>
                    <?= htmlspecialchars($nomeUsuario) ?>
                </a>

            <?php else: ?>

                <a href="login.php">
                    <i class="fa-regular fa-user"></i>
                    Login
                </a>

            <?php endif; ?>

        </div>

    </div>


    <nav class="menu">

        <ul class="menu-links" id="js-menu-links">

            <li><a href="index.php">Início</a></li>

            <li><a href="sobre.php">Sobre</a></li>

            <li><a href="guia.php">Guia para Famílias</a></li>

            <li><a href="educacaoinclusiva.php">Educação Inclusiva</a></li>

            <li><a href="biblioteca.php">Biblioteca</a></li>

            <li><a href="leis.php">Direitos</a></li>

            <li><a href="faq.php">FAQ</a></li>

            <li><a href="contato.php">Contato</a></li>

        </ul>

    </nav>

</header>