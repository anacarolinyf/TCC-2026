<?php

session_start();

require_once "conexao.php";


/* =========================
   VERIFICA LOGIN
   ========================= */

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}


$usuarioId = $_SESSION['usuario_id'];


/* =========================
   BUSCA USUÁRIO
   ========================= */

$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $usuarioId);

$stmt->execute();

$resultado = $stmt->get_result();

$usuario = $resultado->fetch_assoc();


if (!$usuario) {
    session_destroy();

    header("Location: login.php");
    exit;
}


$nomeUsuario = $usuario['nome'];
$emailUsuario = $usuario['email'];

$fotoUsuario = $usuario['foto'] ?? null;


/* =========================
   FAVORITOS
   ========================= */

$favoritos = [];

$sqlFavoritos = "
    SELECT *
    FROM favoritos
    WHERE usuario_id = ?
    ORDER BY id DESC
";

$stmtFavoritos = $conexao->prepare($sqlFavoritos);

$stmtFavoritos->bind_param("i", $usuarioId);

$stmtFavoritos->execute();

$resultadoFavoritos = $stmtFavoritos->get_result();

while ($favorito = $resultadoFavoritos->fetch_assoc()) {

    $favoritos[] = $favorito;

}


/* =========================
   CONTATOS REALIZADOS
   ========================= */

$contatos = [];

$sqlContatos = "
    SELECT *
    FROM contatos_medicos
    WHERE usuario_id = ?
    ORDER BY ultima_conversa DESC
";

$stmtContatos = $conexao->prepare($sqlContatos);

$stmtContatos->bind_param("i", $usuarioId);

$stmtContatos->execute();

$resultadoContatos = $stmtContatos->get_result();

while ($contato = $resultadoContatos->fetch_assoc()) {

    $contatos[] = $contato;

}

?>


<!DOCTYPE html>


<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Meu perfil - ForTEA</title>

    <link rel="stylesheet"
          href="css/estilo.css">

    <link rel="stylesheet"
          href="css/perfil.css">

    <link rel="icon"
          type="image"
          href="img/logoo.png">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>


<body>

<?php include "chatbot/chatbot.php"; ?>

<link rel="stylesheet" href="chatbot/chatbot.css">
<script src="chatbot/chatbot.js"></script>


<header>

    <div class="topo">

        <div class="logo">

            <img src="img/logoo.png"
                 alt="Logo">

            <h2>ForTEA</h2>

        </div>


        <div class="acoes">

            <div class="pesquisa">

                <input type="text"
                       placeholder="O que você procura?">

            </div>


            <a href="perfil.php"
               class="usuario-logado">

                <i class="fa-regular fa-user"></i>

                <?= htmlspecialchars($nomeUsuario) ?>

            </a>

            <a href="configuracoes.php" class="menu-configuracoes">
                    <i class="fa-solid fa-gear"></i>
                    
                </a>

        </div>

    </div>


    <nav class="menu">

        <ul class="menu-links">

            <li>
                <a href="index.php">Início</a>
            </li>

            <li>
                <a href="sobre.php">Sobre</a>
            </li>

            <li>
                <a href="guia.php">Guia para Famílias</a>
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
                <a href="direitos.php">
                    Direitos
                </a>
            </li>

            <li>
                <a href="faq.php">FAQ</a>
            </li>

            <li>
                <a href="contato.php">Contato</a>
            </li>

        </ul>

    </nav>

</header>


<main class="perfil-pagina">


    <section class="perfil-card">


        <!-- TOPO DO PERFIL -->

        <div class="perfil-topo">


            <div class="perfil-avatar">

                <?php if (!empty($fotoUsuario)): ?>

                    <img src="<?= htmlspecialchars($fotoUsuario) ?>"
                         alt="Foto de perfil">

                <?php else: ?>

                    <?= strtoupper(
                        substr($nomeUsuario, 0, 1)
                    ) ?>

                <?php endif; ?>

            </div>


            <div class="perfil-titulo">

                <h1>
                    <?= htmlspecialchars($nomeUsuario) ?>
                </h1>

                <p>
                    Bem-vindo ao seu perfil ForTEA.
                </p>

            </div>


            <a href="editar_perfil.php"
               class="botao-editar-topo">

                <i class="fa-solid fa-pen"></i>

                Editar perfil

            </a>

        </div>


        <!-- ABAS -->

        <div class="perfil-abas">


            <button class="aba ativa"
                    onclick="mostrarAba('informacoes', this)">

                <i class="fa-regular fa-user"></i>

                Informações

            </button>


            <button class="aba"
                    onclick="mostrarAba('favoritos', this)">

                <i class="fa-regular fa-heart"></i>

                Favoritos

            </button>


            <button class="aba"
                    onclick="mostrarAba('contatos', this)">

                <i class="fa-regular fa-comments"></i>

                Contatos realizados

            </button>


        </div>


        <!-- =========================
             INFORMAÇÕES
             ========================= -->

        <div id="informacoes"
             class="conteudo-aba ativa">


            <h2>
                Informações da conta
            </h2>


            <div class="perfil-campo">

                <label>
                    Nome completo
                </label>

                <div class="perfil-valor">

                    <?= htmlspecialchars($nomeUsuario) ?>

                </div>

            </div>


            <div class="perfil-campo">

                <label>
                    E-mail
                </label>

                <div class="perfil-valor">

                    <?= htmlspecialchars($emailUsuario) ?>

                </div>

            </div>


        </div>


        <!-- =========================
             FAVORITOS
             ========================= -->

        <div id="favoritos"
             class="conteudo-aba">


            <div class="aba-titulo">

                <h2>
                    Meus favoritos
                </h2>

                <p>
                    Médicos e profissionais que você salvou.
                </p>

            </div>


            <?php if (count($favoritos) > 0): ?>


                <div class="lista-profissionais">


                    <?php foreach ($favoritos as $favorito): ?>


                        <div class="profissional-card">


                            <div class="profissional-icone">

                                <i class="fa-solid fa-user-doctor"></i>

                            </div>


                            <div class="profissional-info">

                                <h3>

                                    <?= htmlspecialchars(
                                        $favorito['medico_nome']
                                    ) ?>

                                </h3>


                                <p>

                                    <?= htmlspecialchars(
                                        $favorito['especialidade']
                                    ) ?>

                                </p>

                            </div>


                            <i class="fa-solid fa-heart coracao-favorito"></i>


                        </div>


                    <?php endforeach; ?>


                </div>


            <?php else: ?>


                <div class="estado-vazio">

                    <i class="fa-regular fa-heart"></i>

                    <h3>
                        Você ainda não tem favoritos
                    </h3>

                    <p>
                        Quando você favoritar um profissional,
                        ele aparecerá aqui.
                    </p>

                </div>


            <?php endif; ?>


        </div>


        <!-- =========================
             CONTATOS
             ========================= -->

        <div id="contatos"
             class="conteudo-aba">


            <div class="aba-titulo">

                <h2>
                    Contatos realizados
                </h2>

                <p>
                    Médicos e profissionais com quem você já conversou.
                </p>

            </div>


            <?php if (count($contatos) > 0): ?>


                <div class="lista-profissionais">


                    <?php foreach ($contatos as $contato): ?>


                        <div class="profissional-card">


                            <div class="profissional-icone">

                                <i class="fa-solid fa-user-doctor"></i>

                            </div>


                            <div class="profissional-info">

                                <h3>

                                    <?= htmlspecialchars(
                                        $contato['medico_nome']
                                    ) ?>

                                </h3>


                                <p>

                                    <?= htmlspecialchars(
                                        $contato['especialidade']
                                    ) ?>

                                </p>


                                <small>

                                    Última conversa:

                                    <?= date(
                                        "d/m/Y",
                                        strtotime(
                                            $contato['ultima_conversa']
                                        )
                                    ) ?>

                                </small>

                            </div>


                            <a href="chat.php?medico=<?= $contato['id'] ?>"
                               class="botao-conversar">

                                Conversar novamente

                            </a>


                        </div>


                    <?php endforeach; ?>


                </div>


            <?php else: ?>


                <div class="estado-vazio">

                    <i class="fa-regular fa-comments"></i>

                    <h3>
                        Nenhum contato realizado
                    </h3>

                    <p>
                        Os profissionais com quem você conversar
                        aparecerão aqui.
                    </p>

                </div>


            <?php endif; ?>


        </div>


        <!-- SAIR -->

        <div class="perfil-final">

            <a href="logout.php"
               class="botao-sair">

                <i class="fa-solid fa-right-from-bracket"></i>

                Sair da conta

            </a>

        </div>


    </section>

</main>


<script>

function mostrarAba(nome, botao) {

    const abas = document.querySelectorAll(".conteudo-aba");

    abas.forEach(function(aba) {

        aba.classList.remove("ativa");

    });


    const botoes = document.querySelectorAll(".aba");

    botoes.forEach(function(item) {

        item.classList.remove("ativa");

    });


    document.getElementById(nome).classList.add("ativa");

    botao.classList.add("ativa");

}

</script>


</body>

</html>