<?php

session_start();

require_once "conexao.php";


/* ==========================================================
   VERIFICAR LOGIN
========================================================== */

if (!isset($_SESSION['usuario_id'])) {

    header("Location: login.php");
    exit;

}

$usuarioId = (int) $_SESSION['usuario_id'];

$sucesso = '';
$erro = '';


/* ==========================================================
   GARANTIR PREFERÊNCIAS DO USUÁRIO
========================================================== */

$stmt = $conexao->prepare(
    "INSERT IGNORE INTO preferencias_usuario (usuario_id)
     VALUES (?)"
);

if ($stmt) {

    $stmt->bind_param("i", $usuarioId);

    $stmt->execute();

    $stmt->close();

}


/* ==========================================================
   SALVAR CONFIGURAÇÕES
========================================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $secao = $_POST['secao'] ?? '';


    /* ======================================================
       APARÊNCIA
    ====================================================== */

    if ($secao === 'aparencia') {

        $modoEscuro =
            isset($_POST['modo_escuro']) ? 1 : 0;


        $stmt = $conexao->prepare(
            "UPDATE preferencias_usuario
             SET modo_escuro = ?
             WHERE usuario_id = ?"
        );

        if ($stmt) {

            $stmt->bind_param(
                "ii",
                $modoEscuro,
                $usuarioId
            );

            if ($stmt->execute()) {

                $sucesso =
                    "Aparência atualizada com sucesso!";

            } else {

                $erro =
                    "Não foi possível salvar a aparência.";

            }

            $stmt->close();

        }

    }


    /* ======================================================
       ACESSIBILIDADE
    ====================================================== */

    elseif ($secao === 'acessibilidade') {

        $reduzirAnimacoes =
            isset($_POST['reduzir_animacoes']) ? 1 : 0;


        $tamanhoFonte =
            $_POST['tamanho_fonte'] ?? 'normal';


        $daltonismo =
            $_POST['daltonismo'] ?? 'nenhum';


        /* -----------------------------------------------
           VALIDAR TAMANHO DA FONTE
        ------------------------------------------------ */

        $tamanhosPermitidos = [

            'pequena',
            'normal',
            'grande',
            'muito_grande'

        ];


        if (
            !in_array(
                $tamanhoFonte,
                $tamanhosPermitidos,
                true
            )
        ) {

            $tamanhoFonte = 'normal';

        }


        /* -----------------------------------------------
           VALIDAR DALTONISMO
        ------------------------------------------------ */

        $daltonismoPermitido = [

            'nenhum',
            'protanopia',
            'deuteranopia',
            'tritanopia',
            'acromatopsia'

        ];


        if (
            !in_array(
                $daltonismo,
                $daltonismoPermitido,
                true
            )
        ) {

            $daltonismo = 'nenhum';

        }


        /* -----------------------------------------------
           SALVAR
        ------------------------------------------------ */

        $stmt = $conexao->prepare(
            "UPDATE preferencias_usuario
             SET
                reduzir_animacoes = ?,
                tamanho_fonte = ?,
                daltonismo = ?
             WHERE usuario_id = ?"
        );


        if ($stmt) {

            $stmt->bind_param(
                "issi",
                $reduzirAnimacoes,
                $tamanhoFonte,
                $daltonismo,
                $usuarioId
            );


            if ($stmt->execute()) {

                $sucesso =
                    "Acessibilidade atualizada com sucesso!";

            } else {

                $erro =
                    "Não foi possível salvar a acessibilidade.";

            }


            $stmt->close();

        }

    }


    /* ======================================================
       NOTIFICAÇÕES
    ====================================================== */

    elseif ($secao === 'notificacoes') {

        $notificacoesSistema =
            isset($_POST['notificacoes_sistema'])
                ? 1
                : 0;


        $notificacoesLembretes =
            isset($_POST['notificacoes_lembretes'])
                ? 1
                : 0;


        $notificacoesNovidades =
            isset($_POST['notificacoes_novidades'])
                ? 1
                : 0;


        $stmt = $conexao->prepare(
            "UPDATE preferencias_usuario
             SET
                notificacoes_sistema = ?,
                notificacoes_lembretes = ?,
                notificacoes_novidades = ?
             WHERE usuario_id = ?"
        );


        if ($stmt) {

            $stmt->bind_param(
                "iiii",
                $notificacoesSistema,
                $notificacoesLembretes,
                $notificacoesNovidades,
                $usuarioId
            );


            if ($stmt->execute()) {

                $sucesso =
                    "Preferências de notificações salvas!";

            } else {

                $erro =
                    "Não foi possível salvar as notificações.";

            }


            $stmt->close();

        }

    }

}


/* ==========================================================
   CARREGAR PREFERÊNCIAS
========================================================== */

$preferencias = [

    'modo_escuro' => 0,

    'reduzir_animacoes' => 0,

    'tamanho_fonte' => 'normal',

    'daltonismo' => 'nenhum',

    'notificacoes_sistema' => 1,

    'notificacoes_lembretes' => 1,

    'notificacoes_novidades' => 1

];


$stmt = $conexao->prepare(
    "SELECT
        modo_escuro,
        reduzir_animacoes,
        tamanho_fonte,
        daltonismo,
        notificacoes_sistema,
        notificacoes_lembretes,
        notificacoes_novidades
     FROM preferencias_usuario
     WHERE usuario_id = ?
     LIMIT 1"
);


if ($stmt) {

    $stmt->bind_param(
        "i",
        $usuarioId
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();


    if ($resultado->num_rows > 0) {

        $preferencias =
            array_merge(
                $preferencias,
                $resultado->fetch_assoc()
            );

    }


    $stmt->close();

}


/* ==========================================================
   CONFIGURAÇÕES GERAIS DO SITE
========================================================== */

$config = [];

$resultadoConfig = $conexao->query(
    "SELECT chave, valor FROM configuracoes"
);


if ($resultadoConfig) {

    while ($row = $resultadoConfig->fetch_assoc()) {

        $config[$row['chave']] =
            $row['valor'];

    }

}


/* ==========================================================
   HEADER
========================================================== */

require_once "includes/header.php";

?>


<link
    rel="stylesheet"
    href="css/configuracoes.css"
>


<div class="config-container">


    <!-- =====================================================
         CABEÇALHO
    ====================================================== -->

    <div class="config-header">

        <h1>

            <i class="fa-solid fa-gear"></i>

            Configurações

        </h1>


        <p>

            Gerencie sua conta e suas preferências

        </p>

    </div>


    <!-- =====================================================
         SUCESSO
    ====================================================== -->

    <?php if (!empty($sucesso)): ?>

        <div class="alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <?= htmlspecialchars($sucesso) ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         ERRO
    ====================================================== -->

    <?php if (!empty($erro)): ?>

        <div class="alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <?= htmlspecialchars($erro) ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         MENU
    ====================================================== -->

    <div class="config-card">


        <!-- MINHA CONTA -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('conta')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="config-info">

                <h3>Minha conta</h3>

                <p>
                    Nome, e-mail, foto e informações pessoais
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>


        <!-- NOTIFICAÇÕES -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('notificacoes')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-bell"></i>

            </div>


            <div class="config-info">

                <h3>Notificações</h3>

                <p>
                    Escolha quais notificações deseja receber
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>


        <!-- APARÊNCIA -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('aparencia')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-palette"></i>

            </div>


            <div class="config-info">

                <h3>Aparência</h3>

                <p>
                    Personalize a aparência do ForTEA
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>


        <!-- ACESSIBILIDADE -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('acessibilidade')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-universal-access"></i>

            </div>


            <div class="config-info">

                <h3>Acessibilidade</h3>

                <p>
                    Ajuste o site às suas necessidades
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>


        <!-- PRIVACIDADE -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('privacidade')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-lock"></i>

            </div>


            <div class="config-info">

                <h3>Privacidade e segurança</h3>

                <p>
                    Senha, segurança e privacidade
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>


        <!-- TERMOS -->

        <button
            type="button"
            class="config-item"
            onclick="abrirConfiguracao('termos')"
        >

            <div class="config-icon">

                <i class="fa-solid fa-file-lines"></i>

            </div>


            <div class="config-info">

                <h3>Termos e privacidade</h3>

                <p>
                    Consulte nossos documentos
                </p>

            </div>


            <div class="config-arrow">

                <i class="fa-solid fa-chevron-right"></i>

            </div>

        </button>

    </div>

</div>


<!-- ==========================================================
     MODAL
========================================================== -->

<div
    id="configModal"
    class="config-modal"
    onclick="fecharModalFora(event)"
>


    <div
        class="config-modal-content"
        onclick="event.stopPropagation()"
    >


        <!-- HEADER -->

        <div class="modal-header">

            <h2 id="modalTitulo">
                Configuração
            </h2>


            <button
                type="button"
                class="modal-close"
                onclick="fecharConfiguracao()"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        <!-- FORM -->

        <form
            method="POST"
            id="configForm"
        >

            <div
                id="modalBody"
                class="modal-body"
            ></div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancelar"
                    onclick="fecharConfiguracao()"
                >

                    Cancelar

                </button>


                <button
                    type="submit"
                    class="btn-salvar"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    Salvar alterações

                </button>

            </div>

        </form>

    </div>

</div>


<script>


/* ==========================================================
   ABRIR CONFIGURAÇÃO
========================================================== */

function abrirConfiguracao(tipo) {

    const modal =
        document.getElementById('configModal');


    const titulo =
        document.getElementById('modalTitulo');


    const body =
        document.getElementById('modalBody');


    let conteudo = '';


    /* ======================================================
       MINHA CONTA
    ====================================================== */

    if (tipo === 'conta') {

        titulo.innerText =
            'Minha conta';


        conteudo = `

            <div class="form-group">

                <label>Nome</label>

                <input
                    type="text"
                    value="<?= htmlspecialchars($_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? '') ?>"
                    disabled
                >

            </div>


            <div class="form-group">

                <label>E-mail</label>

                <input
                    type="text"
                    value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>"
                    disabled
                >

            </div>


            <p class="config-info-extra">

                Para alterar seus dados pessoais,
                utilize a opção de edição do perfil.

            </p>

        `;

    }


    /* ======================================================
       NOTIFICAÇÕES
    ====================================================== */

    else if (tipo === 'notificacoes') {

        titulo.innerText =
            'Notificações';


        conteudo = `

            <input
                type="hidden"
                name="secao"
                value="notificacoes"
            >


            <div class="config-option">

                <div>

                    <strong>
                        Notificações do sistema
                    </strong>

                    <p>
                        Receber notificações importantes do ForTEA.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="notificacoes_sistema"

                        <?= $preferencias['notificacoes_sistema']
                            ? 'checked'
                            : '' ?>
                    >

                    <span class="slider"></span>

                </label>

            </div>


            <div class="config-option">

                <div>

                    <strong>
                        Lembretes
                    </strong>

                    <p>
                        Receber lembretes e avisos.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="notificacoes_lembretes"

                        <?= $preferencias['notificacoes_lembretes']
                            ? 'checked'
                            : '' ?>
                    >

                    <span class="slider"></span>

                </label>

            </div>


            <div class="config-option">

                <div>

                    <strong>
                        Novidades do ForTEA
                    </strong>

                    <p>
                        Receber novidades e atualizações.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="notificacoes_novidades"

                        <?= $preferencias['notificacoes_novidades']
                            ? 'checked'
                            : '' ?>
                    >

                    <span class="slider"></span>

                </label>

            </div>

        `;

    }


    /* ======================================================
       APARÊNCIA
    ====================================================== */

    else if (tipo === 'aparencia') {

        titulo.innerText =
            'Aparência';


        conteudo = `

            <input
                type="hidden"
                name="secao"
                value="aparencia"
            >


            <div class="config-option">

                <div>

                    <strong>
                        Modo escuro
                    </strong>

                    <p>
                        Ativar aparência escura no ForTEA.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="modo_escuro"

                        <?= $preferencias['modo_escuro']
                            ? 'checked'
                            : '' ?>
                    >

                    <span class="slider"></span>

                </label>

            </div>

        `;

    }


    /* ======================================================
       ACESSIBILIDADE
    ====================================================== */

    else if (tipo === 'acessibilidade') {

        titulo.innerText =
            'Acessibilidade';


        conteudo = `

            <input
                type="hidden"
                name="secao"
                value="acessibilidade"
            >


            <!-- REDUZIR ANIMAÇÕES -->

            <div class="config-option">

                <div>

                    <strong>
                        Reduzir animações
                    </strong>

                    <p>
                        Reduz movimentos e efeitos visuais.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="reduzir_animacoes"

                        <?= $preferencias['reduzir_animacoes']
                            ? 'checked'
                            : '' ?>
                    >

                    <span class="slider"></span>

                </label>

            </div>


            <!-- TAMANHO DA FONTE -->

            <div class="form-group">

                <label>
                    Tamanho da fonte
                </label>


                <select name="tamanho_fonte">


                    <option
                        value="pequena"

                        <?= $preferencias['tamanho_fonte'] === 'pequena'
                            ? 'selected'
                            : '' ?>
                    >

                        Pequena

                    </option>


                    <option
                        value="normal"

                        <?= $preferencias['tamanho_fonte'] === 'normal'
                            ? 'selected'
                            : '' ?>
                    >

                        Normal

                    </option>


                    <option
                        value="grande"

                        <?= $preferencias['tamanho_fonte'] === 'grande'
                            ? 'selected'
                            : '' ?>
                    >

                        Grande

                    </option>


                    <option
                        value="muito_grande"

                        <?= $preferencias['tamanho_fonte'] === 'muito_grande'
                            ? 'selected'
                            : '' ?>
                    >

                        Muito grande

                    </option>

                </select>

            </div>


            <!-- DALTONISMO -->

            <div class="form-group">

                <label>
                    Adaptação para daltonismo
                </label>


                <select name="daltonismo">


                    <option
                        value="nenhum"

                        <?= $preferencias['daltonismo'] === 'nenhum'
                            ? 'selected'
                            : '' ?>
                    >

                        Normal

                    </option>


                    <option
                        value="protanopia"

                        <?= $preferencias['daltonismo'] === 'protanopia'
                            ? 'selected'
                            : '' ?>
                    >

                        Protanopia

                    </option>


                    <option
                        value="deuteranopia"

                        <?= $preferencias['daltonismo'] === 'deuteranopia'
                            ? 'selected'
                            : '' ?>
                    >

                        Deuteranopia

                    </option>


                    <option
                        value="tritanopia"

                        <?= $preferencias['daltonismo'] === 'tritanopia'
                            ? 'selected'
                            : '' ?>
                    >

                        Tritanopia

                    </option>


                    <option
                        value="acromatopsia"

                        <?= $preferencias['daltonismo'] === 'acromatopsia'
                            ? 'selected'
                            : '' ?>
                    >

                        Acromatopsia

                    </option>

                </select>

            </div>

        `;

    }


    /* ======================================================
       PRIVACIDADE
    ====================================================== */

    else if (tipo === 'privacidade') {

        titulo.innerText =
            'Privacidade e segurança';


        conteudo = `

            <div class="form-group">

                <label>
                    Senha atual
                </label>

                <input
                    type="password"
                    name="senha_atual"
                >

            </div>


            <div class="form-group">

                <label>
                    Nova senha
                </label>

                <input
                    type="password"
                    name="nova_senha"
                >

            </div>


            <div class="form-group">

                <label>
                    Confirmar nova senha
                </label>

                <input
                    type="password"
                    name="confirmar_senha"
                >

            </div>

        `;

    }


    /* ======================================================
       TERMOS
    ====================================================== */

    else if (tipo === 'termos') {

        titulo.innerText =
            'Termos e privacidade';


        conteudo = `

            <div class="document-box">

                <i class="fa-solid fa-file-contract"></i>


                <strong>
                    Termos de uso
                </strong>


                <p>
                    Consulte os termos de utilização
                    da plataforma ForTEA.
                </p>


                <button
                    type="button"
                    onclick="alert('Página de termos será adicionada.')"
                >

                    Visualizar termos

                </button>

            </div>


            <div class="document-box">

                <i class="fa-solid fa-shield-halved"></i>


                <strong>
                    Política de privacidade
                </strong>


                <p>
                    Consulte a política de privacidade
                    do ForTEA.
                </p>


                <button
                    type="button"
                    onclick="alert('Página de privacidade será adicionada.')"
                >

                    Visualizar política

                </button>

            </div>

        `;

    }


    /* ======================================================
       INSERIR CONTEÚDO
    ====================================================== */

    body.innerHTML =
        conteudo;


    modal.classList.add('active');


    document.body.style.overflow =
        'hidden';

}


/* ==========================================================
   FECHAR MODAL
========================================================== */

function fecharConfiguracao() {

    document
        .getElementById('configModal')
        .classList.remove('active');


    document.body.style.overflow =
        '';

}


/* ==========================================================
   FECHAR CLICANDO FORA
========================================================== */

function fecharModalFora(event) {

    const modal =
        document.getElementById('configModal');


    if (event.target === modal) {

        fecharConfiguracao();

    }

}


/* ==========================================================
   ESC
========================================================== */

document.addEventListener(
    'keydown',
    function(event) {

        if (event.key === 'Escape') {

            fecharConfiguracao();

        }

    }
);

</script>