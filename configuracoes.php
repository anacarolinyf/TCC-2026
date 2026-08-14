<?php

session_start();

require_once 'conexao.php';
require_once 'includes/header.php';

/*
|--------------------------------------------------------------------------
| SALVAR CONFIGURAÇÕES
|--------------------------------------------------------------------------
*/

$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $configuracoes = [
        'nome_site'        => $_POST['nome_site'] ?? '',
        'descricao_site'   => $_POST['descricao_site'] ?? '',
        'email_contato'    => $_POST['email_contato'] ?? '',
        'telefone'         => $_POST['telefone'] ?? '',
        'endereco'         => $_POST['endereco'] ?? '',
        'instagram'        => $_POST['instagram'] ?? '',
        'facebook'         => $_POST['facebook'] ?? '',
        'youtube'          => $_POST['youtube'] ?? '',
        'linkedin'         => $_POST['linkedin'] ?? '',
        'cor_principal'    => $_POST['cor_principal'] ?? '#2454A6',
        'cor_secundaria'   => $_POST['cor_secundaria'] ?? '#193F80',
        'meta_title'       => $_POST['meta_title'] ?? '',
        'meta_description' => $_POST['meta_description'] ?? ''
    ];

    $sql = "UPDATE configuracoes
            SET valor = ?
            WHERE chave = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar atualização: " . $conexao->error);
    }

    foreach ($configuracoes as $chave => $valor) {

        $stmt->bind_param("ss", $valor, $chave);

        if (!$stmt->execute()) {
            die("Erro ao salvar configuração: " . $stmt->error);
        }
    }

    $stmt->close();

    $sucesso = "Configurações atualizadas com sucesso!";
}


/*
|--------------------------------------------------------------------------
| CARREGAR CONFIGURAÇÕES
|--------------------------------------------------------------------------
*/

$config = [];

$resultado = $conexao->query(
    "SELECT chave, valor FROM configuracoes"
);

if (!$resultado) {
    die("Erro ao carregar configurações: " . $conexao->error);
}

while ($row = $resultado->fetch_assoc()) {
    $config[$row['chave']] = $row['valor'];
}

?>

<link rel="stylesheet" href="css/configuracoes.css">


<div class="config-container">

    <!-- CABEÇALHO -->

    <div class="config-header">

        <h1>
            <i class="fa-solid fa-gear"></i>
            Configurações
        </h1>

        <p>
            Gerencie sua conta e suas preferências
        </p>

    </div>


    <!-- MENSAGEM DE SUCESSO -->

    <?php if (!empty($sucesso)): ?>

        <div class="alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <?= htmlspecialchars($sucesso) ?>

        </div>

    <?php endif; ?>


    <!-- MENU DE CONFIGURAÇÕES -->

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


        <form method="POST">

            <div
                id="modalBody"
                class="modal-body"
            >

            </div>


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

function abrirConfiguracao(tipo) {

    const modal = document.getElementById('configModal');
    const titulo = document.getElementById('modalTitulo');
    const body = document.getElementById('modalBody');

    let conteudo = '';


    /*
    |--------------------------------------------------------------------------
    | MINHA CONTA
    |--------------------------------------------------------------------------
    */

    if (tipo === 'conta') {

        titulo.innerText = 'Minha conta';

        conteudo = `

            <div class="form-group">

                <label>Nome</label>

                <input
                    type="text"
                    name="nome_site"
                    value="<?= htmlspecialchars($config['nome_site'] ?? '') ?>"
                >

            </div>

            <div class="form-group">

                <label>Descrição</label>

                <textarea
                    name="descricao_site"
                ><?= htmlspecialchars($config['descricao_site'] ?? '') ?></textarea>

            </div>

        `;
    }


    /*
    |--------------------------------------------------------------------------
    | NOTIFICAÇÕES
    |--------------------------------------------------------------------------
    */

    else if (tipo === 'notificacoes') {

        titulo.innerText = 'Notificações';

        conteudo = `

            <div class="config-option">

                <div>

                    <strong>Notificações do sistema</strong>

                    <p>
                        Receber notificações importantes do ForTEA.
                    </p>

                </div>

                <label class="switch">

                    <input type="checkbox">

                    <span class="slider"></span>

                </label>

            </div>


            <div class="config-option">

                <div>

                    <strong>Lembretes</strong>

                    <p>
                        Receber lembretes e avisos.
                    </p>

                </div>

                <label class="switch">

                    <input type="checkbox">

                    <span class="slider"></span>

                </label>

            </div>

        `;
    }


    /*
    |--------------------------------------------------------------------------
    | APARÊNCIA
    |--------------------------------------------------------------------------
    */

    else if (tipo === 'aparencia') {

        titulo.innerText = 'Aparência';

        conteudo = `

            <div class="form-row">

                <div class="form-group">

                    <label>Cor principal</label>

                    <input
                        type="color"
                        class="color-picker"
                        name="cor_principal"
                        value="<?= htmlspecialchars($config['cor_principal'] ?? '#2454A6') ?>"
                    >

                </div>


                <div class="form-group">

                    <label>Cor secundária</label>

                    <input
                        type="color"
                        class="color-picker"
                        name="cor_secundaria"
                        value="<?= htmlspecialchars($config['cor_secundaria'] ?? '#193F80') ?>"
                    >

                </div>

            </div>

        `;
    }


    /*
    |--------------------------------------------------------------------------
    | ACESSIBILIDADE
    |--------------------------------------------------------------------------
    */

    else if (tipo === 'acessibilidade') {

        titulo.innerText = 'Acessibilidade';

        conteudo = `

            <div class="config-option">

                <div>

                    <strong>Alto contraste</strong>

                    <p>
                        Aumenta o contraste visual dos elementos.
                    </p>

                </div>

                <label class="switch">

                    <input type="checkbox">

                    <span class="slider"></span>

                </label>

            </div>


            <div class="config-option">

                <div>

                    <strong>Reduzir animações</strong>

                    <p>
                        Reduz efeitos e movimentos da interface.
                    </p>

                </div>

                <label class="switch">

                    <input type="checkbox">

                    <span class="slider"></span>

                </label>

            </div>


            <div class="form-group">

                <label>Tamanho da fonte</label>

                <select>

                    <option>Normal</option>

                    <option>Grande</option>

                    <option>Muito grande</option>

                </select>

            </div>

        `;
    }


    /*
    |--------------------------------------------------------------------------
    | PRIVACIDADE
    |--------------------------------------------------------------------------
    */

    else if (tipo === 'privacidade') {

        titulo.innerText = 'Privacidade e segurança';

        conteudo = `

            <div class="form-group">

                <label>Senha atual</label>

                <input
                    type="password"
                    name="senha_atual"
                >

            </div>


            <div class="form-group">

                <label>Nova senha</label>

                <input
                    type="password"
                    name="nova_senha"
                >

            </div>


            <div class="form-group">

                <label>Confirmar nova senha</label>

                <input
                    type="password"
                    name="confirmar_senha"
                >

            </div>

        `;
    }


    /*
    |--------------------------------------------------------------------------
    | TERMOS
    |--------------------------------------------------------------------------
    */

    else if (tipo === 'termos') {

        titulo.innerText = 'Termos e privacidade';

        conteudo = `

            <div class="document-box">

                <i class="fa-solid fa-file-contract"></i>

                <strong>Termos de uso</strong>

                <p>
                    Consulte os termos de utilização da plataforma ForTEA.
                </p>

                <button type="button">
                    Visualizar termos
                </button>

            </div>


            <div class="document-box">

                <i class="fa-solid fa-shield-halved"></i>

                <strong>Política de privacidade</strong>

                <p>
                    Consulte a política de privacidade do ForTEA.
                </p>

                <button type="button">
                    Visualizar política
                </button>

            </div>

        `;
    }


    body.innerHTML = conteudo;

    modal.classList.add('active');

    document.body.style.overflow = 'hidden';

}


function fecharConfiguracao() {

    document
        .getElementById('configModal')
        .classList.remove('active');

    document.body.style.overflow = '';

}


function fecharModalFora(event) {

    if (
        event.target ===
        document.getElementById('configModal')
    ) {

        fecharConfiguracao();

    }

}


document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {

        fecharConfiguracao();

    }

});

</script>

</body>
</html>