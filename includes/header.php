<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? null;


/*
|--------------------------------------------------------------------------
| CARREGAR CONFIGURAÇÕES DO SITE
|--------------------------------------------------------------------------
*/

$configSite = [];

if (isset($conexao)) {

    $resultadoConfig = $conexao->query(
        "SELECT chave, valor FROM configuracoes"
    );

    if ($resultadoConfig) {

        while ($row = $resultadoConfig->fetch_assoc()) {

            $configSite[$row['chave']] = $row['valor'];

        }

    }

}


/*
|--------------------------------------------------------------------------
| CORES
|--------------------------------------------------------------------------
*/

$corPrincipal = $configSite['cor_principal'] ?? '#2454A6';

$corSecundaria = $configSite['cor_secundaria'] ?? '#193F80';


/*
|--------------------------------------------------------------------------
| CLASSES DE ACESSIBILIDADE
|--------------------------------------------------------------------------
*/

$classesBody = [];


/* MODO ESCURO */

if (($configSite['modo_escuro'] ?? '0') === '1') {

    $classesBody[] = 'modo-escuro';

}


/* ALTO CONTRASTE */

if (($configSite['alto_contraste'] ?? '0') === '1') {

    $classesBody[] = 'alto-contraste';

}


/* REDUZIR ANIMAÇÕES */

if (($configSite['reduzir_animacoes'] ?? '0') === '1') {

    $classesBody[] = 'reduzir-animacoes';

}


/* TAMANHO DA FONTE */

$tamanhoFonte = $configSite['tamanho_fonte'] ?? 'normal';

$classesBody[] = 'fonte-' . $tamanhoFonte;

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <!-- CSS PRINCIPAL -->

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

    <!-- CSS DAS LEIS E CONTATO -->

    <link
        rel="stylesheet"
        href="css/leisecontato.css"
    >

    <!-- CSS DAS CONFIGURAÇÕES -->

    <link
        rel="stylesheet"
        href="css/configuracoes.css"
    >

    <!-- CSS DO PERFIL -->

    <link
        rel="stylesheet"
        href="css/perfil.css"
    >

    <title>ForTEA</title>

    <link
        rel="icon"
        type="image"
        href="img/logoo.png"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    <!-- CORES PERSONALIZADAS -->

    <style>

        :root {

            --cor-principal:
                <?= htmlspecialchars($corPrincipal) ?>;

            --cor-secundaria:
                <?= htmlspecialchars($corSecundaria) ?>;

        }

    </style>

</head>


<body class="<?= htmlspecialchars(implode(' ', $classesBody)) ?>">


<!-- ==========================================================
     VLIBRAS
========================================================== -->

<div vw class="enabled">

    <div vw-access-button class="active"></div>

    <div vw-plugin-wrapper>

        <div class="vw-plugin-top-wrapper"></div>

    </div>

</div>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>

    new window.VLibras.Widget(
        "https://vlibras.gov.br/app"
    );

</script>


<!-- ==========================================================
     CHATBOT
========================================================== -->

<?php include "chatbot/chatbot.php"; ?>

<link
    rel="stylesheet"
    href="chatbot/chatbot.css"
>

<script src="chatbot/chatbot.js"></script>


<!-- ==========================================================
     HEADER
========================================================== -->

<header>

    <div class="topo">

        <div class="logo">

            <img
                src="img/logoo.png"
                alt="Logo"
            >

            <h2>ForTEA</h2>

        </div>


        <div class="acoes">

            <div class="pesquisa">

                <input
                    type="text"
                    placeholder="O que você procura?"
                >

            </div>


            <?php if ($nomeUsuario): ?>

                <a
                    href="perfil.php"
                    class="usuario-logado"
                >

                    <i class="fa-regular fa-user"></i>

                    <?= htmlspecialchars($nomeUsuario) ?>

                </a>


                <a
                    href="configuracoes.php"
                    class="menu-configuracoes"
                >

                    <i class="fa-solid fa-gear"></i>

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

        <ul
            class="menu-links"
            id="js-menu-links"
        >

            <li>
                <a href="index.php">
                    Início
                </a>
            </li>

            <li>
                <a href="sobre.php">
                    Sobre
                </a>
            </li>

            <li>
                <a href="guia.php">
                    Guia para Famílias
                </a>
            </li>

            <li>
                <a href="educacaoinclusiva.php">
                    Educação Inclusiva
                </a>
            </li>

            <li>
                <a href="biblioteca.php">
                    Biblioteca
                </a>
            </li>

            <li>
                <a href="leis.php">
                    Direitos
                </a>
            </li>

            <li>
                <a href="faq.php">
                    FAQ
                </a>
            </li>

            <li>
                <a href="contato.php">
                    Contato
                </a>
            </li>

        </ul>

    </nav>

</header>