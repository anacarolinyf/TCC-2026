<?php

// Inicia a sessão caso ainda não esteja iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrega a conexão com o banco
require_once __DIR__ . '/conexao.php';

// Carrega o cabeçalho
include __DIR__ . '/includes/header.php';

?>

<link rel="stylesheet" href="../css/estilo.css">

<?php

/* =========================
   BUSCAR PROFISSIONAIS
========================= */

$profissionais = [];

// Verifica se a conexão existe
if (!isset($conexao) || !$conexao) {
    die("Erro: conexão com o banco de dados não foi encontrada.");
}

// Consulta os profissionais ativos
$sqlProfissionais = "
    SELECT
        id,
        nome,
        especialidade,
        descricao,
        telefone,
        whatsapp,
        foto
    FROM profissionais
    WHERE ativo = 1
    ORDER BY nome ASC
";

$resultadoProfissionais = $conexao->query($sqlProfissionais);

// Verifica se houve erro na consulta
if (!$resultadoProfissionais) {
    die("Erro ao buscar profissionais: " . $conexao->error);
}

// Guarda os profissionais encontrados
while ($profissional = $resultadoProfissionais->fetch_assoc()) {
    $profissionais[] = $profissional;
}

?>

<main class="biblioteca-page">

    <h1>Biblioteca</h1>

    <!-- =========================
         PROFISSIONAIS ESPECIALIZADOS
    ========================= -->

    <section class="profissionais-section">

        <div class="profissionais-container">

            <div class="profissionais-titulo">

                <h2>Profissionais especializados</h2>

                <p>
                    Encontre profissionais especializados que atuam
                    com pessoas com Transtorno do Espectro Autista.
                </p>

            </div>


            <?php if (!empty($profissionais)): ?>

                <div class="profissionais-grid">

                    <?php foreach ($profissionais as $profissional): ?>

                        <div class="profissional-card">

                            <!-- FOTO -->

                            <div class="profissional-foto">

                                <?php if (!empty($profissional['foto'])): ?>

                                    <img
                                        src="<?= htmlspecialchars($profissional['foto']) ?>"
                                        alt="Foto de <?= htmlspecialchars($profissional['nome']) ?>"
                                    >

                                <?php else: ?>

                                    <div class="sem-foto">
                                        <i class="fa-solid fa-user-doctor"></i>
                                    </div>

                                <?php endif; ?>

                            </div>


                            <!-- INFORMAÇÕES -->

                            <div class="profissional-info">

                                <h3>
                                    <?= htmlspecialchars($profissional['nome']) ?>
                                </h3>


                                <?php if (!empty($profissional['especialidade'])): ?>

                                    <span class="profissional-especialidade">
                                        <?= htmlspecialchars($profissional['especialidade']) ?>
                                    </span>

                                <?php endif; ?>


                                <?php if (!empty($profissional['descricao'])): ?>

                                    <p>
                                        <?= nl2br(htmlspecialchars($profissional['descricao'])) ?>
                                    </p>

                                <?php endif; ?>


                                <?php if (!empty($profissional['telefone'])): ?>

                                    <div class="profissional-contato">

                                        <strong>Contato:</strong>

                                        <span>
                                            <?= htmlspecialchars($profissional['telefone']) ?>
                                        </span>

                                    </div>

                                <?php endif; ?>


                                <!-- WHATSAPP -->

                                <?php if (!empty($profissional['whatsapp'])): ?>

                                    <?php

                                    // Remove tudo que não for número
                                    $whatsapp = preg_replace(
                                        '/[^0-9]/',
                                        '',
                                        $profissional['whatsapp']
                                    );

                                    ?>

                                    <?php if (!empty($whatsapp)): ?>

                                        <a
                                            href="https://wa.me/<?= htmlspecialchars($whatsapp) ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn-whatsapp"
                                        >

                                            <i class="fa-brands fa-whatsapp"></i>

                                            Conversar pelo WhatsApp

                                        </a>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>


            <?php else: ?>

                <div class="sem-profissionais">

                    <i class="fa-solid fa-user-doctor"></i>

                    <p>
                        No momento, não há profissionais cadastrados.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>


<?php include __DIR__ . '/includes/footer.php'; ?>