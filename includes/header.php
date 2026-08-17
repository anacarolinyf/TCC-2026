<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario =
    $_SESSION['nome']
    ?? $_SESSION['usuario_nome']
    ?? null;

$usuarioId =
    $_SESSION['usuario_id']
    ?? null;


/*
|--------------------------------------------------------------------------
| CONFIGURAÇÕES GERAIS DO SITE
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
| CORES DO SITE
|--------------------------------------------------------------------------
*/

$corPrincipal =
    $configSite['cor_principal']
    ?? '#2454A6';

$corSecundaria =
    $configSite['cor_secundaria']
    ?? '#193F80';


/*
|--------------------------------------------------------------------------
| PREFERÊNCIAS PADRÃO DO USUÁRIO
|--------------------------------------------------------------------------
*/

$preferenciasUsuario = [

    'modo_escuro' => 0,

    'reduzir_animacoes' => 0,

    'tamanho_fonte' => 'normal',

    'daltonismo' => 'nenhum'

];


/*
|--------------------------------------------------------------------------
| CARREGAR PREFERÊNCIAS DO USUÁRIO LOGADO
|--------------------------------------------------------------------------
*/

if (
    $usuarioId &&
    isset($conexao)
) {

    $stmtPreferencias = $conexao->prepare(

        "SELECT
            modo_escuro,
            reduzir_animacoes,
            tamanho_fonte,
            daltonismo
         FROM preferencias_usuario
         WHERE usuario_id = ?
         LIMIT 1"

    );


    if ($stmtPreferencias) {

        $stmtPreferencias->bind_param(
            "i",
            $usuarioId
        );

        $stmtPreferencias->execute();


        $resultadoPreferencias =
            $stmtPreferencias->get_result();


        if (
            $resultadoPreferencias &&
            $resultadoPreferencias->num_rows > 0
        ) {

            $dadosPreferencias =
                $resultadoPreferencias->fetch_assoc();


            $preferenciasUsuario =
                array_merge(
                    $preferenciasUsuario,
                    $dadosPreferencias
                );

        }


        $stmtPreferencias->close();

    }

}


/*
|--------------------------------------------------------------------------
| CLASSES DE ACESSIBILIDADE
|--------------------------------------------------------------------------
*/

$classesBody = [];


/*
|--------------------------------------------------------------------------
| MODO ESCURO
|--------------------------------------------------------------------------
*/

if (
    (string)$preferenciasUsuario['modo_escuro']
    === '1'
) {

    $classesBody[] =
        'modo-escuro';

}


/*
|--------------------------------------------------------------------------
| REDUZIR ANIMAÇÕES
|--------------------------------------------------------------------------
*/

if (
    (string)$preferenciasUsuario['reduzir_animacoes']
    === '1'
) {

    $classesBody[] =
        'reduzir-animacoes';

}


/*
|--------------------------------------------------------------------------
| TAMANHO DA FONTE
|--------------------------------------------------------------------------
*/

$tamanhosPermitidos = [

    'pequena',
    'normal',
    'grande',
    'muito_grande'

];


$tamanhoFonte =
    $preferenciasUsuario['tamanho_fonte'];


if (
    !in_array(
        $tamanhoFonte,
        $tamanhosPermitidos,
        true
    )
) {

    $tamanhoFonte =
        'normal';

}


$classesBody[] =
    'fonte-' . $tamanhoFonte;


/*
|--------------------------------------------------------------------------
| DALTONISMO
|--------------------------------------------------------------------------
*/

$daltonismosPermitidos = [

    'nenhum',
    'protanopia',
    'deuteranopia',
    'tritanopia',
    'acromatopsia'

];


$daltonismo =
    $preferenciasUsuario['daltonismo'];


if (
    !in_array(
        $daltonismo,
        $daltonismosPermitidos,
        true
    )
) {

    $daltonismo =
        'nenhum';

}


if ($daltonismo !== 'nenhum') {

    $classesBody[] =
        'daltonismo-' . $daltonismo;

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <!-- ======================================================
         CSS PRINCIPAL
    ======================================================= -->

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >


    <!-- ======================================================
         CSS LEIS E CONTATO
    ======================================================= -->

    <link
        rel="stylesheet"
        href="css/leisecontato.css"
    >


    <!-- ======================================================
         CSS CONFIGURAÇÕES
    ======================================================= -->

    <link
        rel="stylesheet"
        href="css/configuracoes.css"
    >


    <!-- ======================================================
         CSS PERFIL
    ======================================================= -->

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


    <!-- ======================================================
         FONTES
    ======================================================= -->

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap"
        rel="stylesheet"
    >


    <!-- ======================================================
         FONT AWESOME
    ======================================================= -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    <!-- ======================================================
         CORES PERSONALIZADAS
    ======================================================= -->

    <style>

        :root {

            --cor-principal:
                <?= htmlspecialchars($corPrincipal) ?>;

            --cor-secundaria:
                <?= htmlspecialchars($corSecundaria) ?>;

        }

    </style>

</head>


<body
    class="<?= htmlspecialchars(
        implode(' ', $classesBody)
    ) ?>"
>


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


        <!-- LOGO -->

        <div class="logo">

            <img
                src="img/logoo.png"
                alt="Logo ForTEA"
            >

            <h2>ForTEA</h2>

        </div>


        <!-- AÇÕES -->

        <div class="acoes">


            <!-- PESQUISA -->

            <div class="pesquisa">

                <input
                    type="text"
                    placeholder="O que você procura?"
                >

            </div>


            <?php if ($nomeUsuario): ?>


                <!-- USUÁRIO -->

                <a
                    href="perfil.php"
                    class="usuario-logado"
                >

                    <i class="fa-regular fa-user"></i>

                    <?= htmlspecialchars(
                        $nomeUsuario
                    ) ?>

                </a>


                <!-- CONFIGURAÇÕES -->

                <a
                    href="configuracoes.php"
                    class="menu-configuracoes"
                    aria-label="Configurações"
                    title="Configurações"
                >

                    <i class="fa-solid fa-gear"></i>

                </a>


            <?php else: ?>


                <!-- LOGIN -->

                <a href="login.php">

                    <i class="fa-regular fa-user"></i>

                    Login

                </a>


            <?php endif; ?>


        </div>

    </div>


    <!-- ======================================================
         MENU
    ======================================================= -->

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