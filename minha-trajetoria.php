<?php 
 
session_start(); 
require_once "conexao.php"; 
 
if (!isset($_SESSION["usuario_id"])) { 
    header("Location: login.php"); 
    exit; 
} 
 
$usuario_id = $_SESSION["usuario_id"]; 
 
 
/* Criar checklists do usuário */ 
 
$sql = "SELECT COUNT(*) AS total 
        FROM trajetoria_checklists 
        WHERE usuario_id = ?"; 
 
$stmt = $conexao->prepare($sql); 
$stmt->bind_param("i", $usuario_id); 
$stmt->execute(); 
 
$resultado = $stmt->get_result(); 
$dados = $resultado->fetch_assoc(); 
 
$stmt->close(); 
 
if ($dados["total"] == 0) { 
 
    $checklists = [ 
        [ 
            "titulo" => "Antes do diagnóstico", 
            "descricao" => "Organize informações e prepare-se para as primeiras avaliações.", 
            "icone" => "fa-magnifying-glass", 
            "ordem" => 1, 
            "itens" => [ 
                "Observar e registrar informações importantes do dia a dia", 
                "Organizar documentos e informações anteriores", 
                "Anotar dúvidas e situações que chamam atenção", 
                "Pesquisar sobre o processo de avaliação", 
                "Buscar orientação de um profissional" 
            ] 
        ], 
        [ 
            "titulo" => "Processo de diagnóstico", 
            "descricao" => "Acompanhe avaliações, consultas e documentos.", 
            "icone" => "fa-clipboard-list", 
            "ordem" => 2, 
            "itens" => [ 
                "Agendar a avaliação", 
                "Organizar documentos para levar às consultas", 
                "Registrar consultas e avaliações realizadas", 
                "Anotar orientações recebidas", 
                "Guardar documentos e relatórios importantes", 
                "Registrar dúvidas para os próximos atendimentos" 
            ] 
        ], 
        [ 
            "titulo" => "Após o diagnóstico", 
            "descricao" => "Organize os próximos passos e acompanhamentos.", 
            "icone" => "fa-heart", 
            "ordem" => 3, 
            "itens" => [ 
                "Organizar o diagnóstico e os documentos recebidos", 
                "Conhecer as possibilidades de acompanhamento", 
                "Registrar profissionais que acompanham a pessoa", 
                "Conhecer direitos e possibilidades de apoio", 
                "Organizar informações importantes para a família", 
                "Manter os registros atualizados" 
            ] 
        ], 
        [ 
            "titulo" => "Escola e inclusão", 
            "descricao" => "Acompanhe questões relacionadas à escola e à inclusão.", 
            "icone" => "fa-school", 
            "ordem" => 4, 
            "itens" => [ 
                "Conversar com a escola sobre as necessidades", 
                "Registrar reuniões e orientações", 
                "Compartilhar informações importantes com a equipe escolar", 
                "Acompanhar adaptações e estratégias utilizadas", 
                "Registrar mudanças importantes na rotina escolar", 
                "Manter comunicação com a escola" 
            ] 
        ] 
    ]; 
 
    foreach ($checklists as $checklist) { 
 
        $sql = "INSERT INTO trajetoria_checklists 
                (usuario_id, titulo, descricao, icone, ordem) 
                VALUES (?, ?, ?, ?, ?)"; 
 
        $stmt = $conexao->prepare($sql); 
 
        $stmt->bind_param( 
            "isssi", 
            $usuario_id, 
            $checklist["titulo"], 
            $checklist["descricao"], 
            $checklist["icone"], 
            $checklist["ordem"] 
        ); 
 
        $stmt->execute(); 
 
        $checklist_id = $conexao->insert_id; 
 
        $stmt->close(); 
 
        foreach ($checklist["itens"] as $ordem => $etapa) { 
 
            $sql = "INSERT INTO trajetoria_itens 
                    (checklist_id, etapa, ordem) 
                    VALUES (?, ?, ?)"; 
 
            $stmt = $conexao->prepare($sql); 
 
            $ordem_item = $ordem + 1; 
 
            $stmt->bind_param( 
                "isi", 
                $checklist_id, 
                $etapa, 
                $ordem_item 
            ); 
 
            $stmt->execute(); 
            $stmt->close(); 
        } 
    } 
} 
 
 
/* Adicionar registro */ 
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["adicionar_registro"])) { 
 
    $titulo = trim($_POST["titulo"]); 
    $tipo = trim($_POST["tipo"]); 
    $data = $_POST["data_registro"]; 
    $profissional = trim($_POST["profissional"]); 
    $local = trim($_POST["local"]); 
    $descricao = trim($_POST["descricao"]); 
 
    if ($titulo != "" && $tipo != "" && $data != "") { 
 
        $sql = "INSERT INTO trajetoria_registros 
                (usuario_id, titulo, tipo, data_registro, profissional, local, descricao) 
                VALUES (?, ?, ?, ?, ?, ?, ?)"; 
 
        $stmt = $conexao->prepare($sql); 
 
        $stmt->bind_param( 
            "issssss", 
            $usuario_id, 
            $titulo, 
            $tipo, 
            $data, 
            $profissional, 
            $local, 
            $descricao 
        ); 
 
        $stmt->execute(); 
        $stmt->close(); 
    } 
 
    header("Location: minha-trajetoria.php"); 
    exit; 
} 
 
 
/* Excluir registro */ 
 
if (isset($_GET["excluir"])) { 
 
    $id = intval($_GET["excluir"]); 
 
    $sql = "DELETE FROM trajetoria_registros 
            WHERE id = ? AND usuario_id = ?"; 
 
    $stmt = $conexao->prepare($sql); 
    $stmt->bind_param("ii", $id, $usuario_id); 
    $stmt->execute(); 
    $stmt->close(); 
 
    header("Location: minha-trajetoria.php"); 
    exit; 
} 
 
 
/* Buscar registros */ 
 
$sql = "SELECT * 
        FROM trajetoria_registros 
        WHERE usuario_id = ? 
        ORDER BY data_registro DESC"; 
 
$stmt = $conexao->prepare($sql); 
$stmt->bind_param("i", $usuario_id); 
$stmt->execute(); 
 
$registros = $stmt->get_result(); 
 
 
/* Buscar checklists */ 
 
$sql = "SELECT * 
        FROM trajetoria_checklists 
        WHERE usuario_id = ? 
        ORDER BY ordem"; 
 
$stmt = $conexao->prepare($sql); 
$stmt->bind_param("i", $usuario_id); 
$stmt->execute(); 
 
$checklists_resultado = $stmt->get_result(); 
 
$checklists = []; 
 
while ($checklist = $checklists_resultado->fetch_assoc()) { 
 
    $checklist_id = $checklist["id"]; 
 
    $sqlItens = "SELECT * 
                 FROM trajetoria_itens 
                 WHERE checklist_id = ? 
                 ORDER BY ordem"; 
 
    $stmtItens = $conexao->prepare($sqlItens); 
    $stmtItens->bind_param("i", $checklist_id); 
    $stmtItens->execute(); 
 
    $itens_resultado = $stmtItens->get_result(); 
 
    $itens = []; 
    $concluidas = 0; 
 
    while ($item = $itens_resultado->fetch_assoc()) { 
 
        $itens[] = $item; 
 
        if ($item["concluida"] == 1) { 
            $concluidas++; 
        } 
    } 
 
    $checklist["itens"] = $itens; 
    $checklist["concluidas"] = $concluidas; 
    $checklist["total"] = count($itens); 
 
    $checklists[] = $checklist; 
 
    $stmtItens->close(); 
} 
 
?> 
 
<?php include "includes/header.php"; ?> 
 
<link rel="stylesheet" href="css/trajetoria.css"> 
 
<main> 
 
<section class="trajetoria-pagina"> 
 
    <div class="container-trajetoria"> 
 
        <a href="guia.php" class="voltar-trajetoria"> 
            <i class="fas fa-arrow-left"></i> 
            Voltar para o Guia 
        </a> 
 
        <div class="trajetoria-intro"> 
            <span>MINHA TRAJETÓRIA</span> 
 
            <h1>Organize cada etapa do caminho</h1> 
 
            <p> 
                Registre acontecimentos importantes e acompanhe cada etapa 
                da trajetória de forma organizada. 
            </p> 
        </div> 
 
 
        <?php 
 
        $total_checklists = count($checklists); 
        $checklists_iniciadas = 0; 
        $total_itens = 0; 
        $total_concluidas = 0; 
 
        foreach ($checklists as $checklist) { 
 
            $total_itens += $checklist["total"]; 
            $total_concluidas += $checklist["concluidas"]; 
 
            if ($checklist["concluidas"] > 0) { 
                $checklists_iniciadas++; 
            } 
        } 
 
        $progresso_geral = $total_itens > 0 
            ? round(($total_concluidas / $total_itens) * 100) 
            : 0; 
 
        ?> 
 
        <div class="resumo-trajetoria"> 
 
            <div class="resumo-card"> 
 
                <div class="resumo-icone"> 
                    <i class="fas fa-clipboard-list"></i> 
                </div> 
 
                <div> 
                    <strong><?php echo $registros->num_rows; ?></strong> 
                    <span>Registros realizados</span> 
                </div> 
 
            </div> 
 
 
            <div class="resumo-card"> 
 
                <div class="resumo-icone"> 
                    <i class="fas fa-list-check"></i> 
                </div> 
 
                <div> 
                    <strong><?php echo $checklists_iniciadas; ?>/<?php echo $total_checklists; ?></strong> 
                    <span>Checklists preenchidas</span> 
                </div> 
 
            </div> 
 
 
            <div class="resumo-card"> 
 
                <div class="resumo-icone"> 
                    <i class="fas fa-route"></i> 
                </div> 
 
                <div> 
                    <strong><?php echo $progresso_geral; ?>%</strong> 
                    <span>Trajetória concluída</span> 
                </div> 
 
            </div> 
 
        </div> 
 
 
        <div class="trajetoria-layout"> 
 
            <!-- REGISTROS --> 
 
            <section class="registro-area"> 
 
                <div class="area-titulo"> 
 
                    <div> 
                        <span>ACOMPANHAMENTO</span> 
                        <h2>Adicionar registro</h2> 
                    </div> 
 
                    <i class="fas fa-pen-to-square"></i> 
 
                </div> 
 
 
                <form method="POST" class="form-registro"> 
 
                    <div class="campo-trajetoria campo-grande"> 
 
                        <label>Título</label> 
 
                        <input 
                            type="text" 
                            name="titulo" 
                            placeholder="Ex.: Consulta com psicólogo" 
                            required 
                        > 
 
                    </div> 
 
 
                    <div class="linha-campos"> 
 
                        <div class="campo-trajetoria"> 
 
                            <label>Tipo</label> 
 
                            <select name="tipo" required> 
 
                                <option value="">Selecione</option> 
 
                                <option value="Consulta">Consulta</option> 
                                <option value="Terapia">Terapia</option> 
                                <option value="Avaliação">Avaliação</option> 
                                <option value="Escola">Escola</option> 
                                <option value="Reunião">Reunião</option> 
                                <option value="Outro">Outro</option> 
 
                            </select> 
 
                        </div> 
 
 
                        <div class="campo-trajetoria"> 
 
                            <label>Data</label> 
 
                            <input 
                                type="date" 
                                name="data_registro" 
                                required 
                            > 
 
                        </div> 
 
                    </div> 
 
 
                    <div class="linha-campos"> 
 
                        <div class="campo-trajetoria"> 
 
                            <label>Profissional</label> 
 
                            <input 
                                type="text" 
                                name="profissional" 
                                placeholder="Nome do profissional" 
                            > 
 
                        </div> 
 
 
                        <div class="campo-trajetoria"> 
 
                            <label>Local</label> 
 
                            <input 
                                type="text" 
                                name="local" 
                                placeholder="Clínica, escola..." 
                            > 
 
                        </div> 
 
                    </div> 
 
 
                    <div class="campo-trajetoria"> 
 
                        <label>Descrição</label> 
 
                        <textarea 
                            name="descricao" 
                            rows="4" 
                            placeholder="Escreva informações importantes sobre esse registro..." 
                        ></textarea> 
 
                    </div> 
 
 
                    <button 
                        type="submit" 
                        name="adicionar_registro" 
                        class="botao-adicionar" 
                    > 
 
                        <i class="fas fa-plus"></i> 
 
                        Adicionar registro 
 
                    </button> 
 
                </form> 
 
            </section> 
 
 
 
            <!-- CHECKLISTS --> 
 
            <section class="checklist-area"> 
 
                <div class="area-titulo"> 
 
                    <div> 
                        <span>ORGANIZAÇÃO</span> 
                        <h2>Checklists da trajetória</h2> 
                    </div> 
 
                    <i class="fas fa-list-check"></i> 
 
                </div> 
 
 
                <p class="checklist-intro"> 
                    Escolha uma etapa para acompanhar suas tarefas. 
                </p> 
 
 
                <div class="lista-checklists"> 
 
                    <?php foreach ($checklists as $checklist): ?> 
 
                        <?php 
                        $total = $checklist["total"]; 
                        $concluidas = $checklist["concluidas"]; 
 
                        $porcentagem = $total > 0 
                            ? round(($concluidas / $total) * 100) 
                            : 0; 
                        ?> 
 
                        <div class="checklist-card"> 
 
                            <div class="checklist-icone"> 
 
                                <i class="fas <?php echo htmlspecialchars($checklist["icone"]); ?>"></i> 
 
                            </div> 
 
 
                            <div class="checklist-card-conteudo"> 
 
                                <h3> 
                                    <?php echo htmlspecialchars($checklist["titulo"]); ?> 
                                </h3> 
 
                                <p> 
                                    <?php echo htmlspecialchars($checklist["descricao"]); ?> 
                                </p> 
 
 
                                <div class="checklist-progresso"> 
 
                                    <div class="checklist-progresso-texto"> 
 
                                        <span> 
                                            <?php echo $concluidas; ?> de <?php echo $total; ?> concluídas 
                                        </span> 
 
                                        <strong> 
                                            <?php echo $porcentagem; ?>% 
                                        </strong> 
 
                                    </div> 
 
 
                                    <div class="checklist-barra"> 
 
                                        <div style="width: <?php echo $porcentagem; ?>%;"></div> 
 
                                    </div> 
 
                                </div> 
 
 
                                <button 
                                    type="button" 
                                    class="botao-checklist" 
                                    onclick="abrirChecklist(<?php echo $checklist["id"]; ?>)" 
                                > 
 
                                    Ver checklist 
 
                                    <i class="fas fa-arrow-right"></i> 
 
                                </button> 
 
                            </div> 
 
                        </div> 
 
                    <?php endforeach; ?> 
 
                </div> 
 
            </section> 
 
        </div> 
 
 
 
        <!-- MODAL CHECKLIST --> 
 
        <div class="checklist-modal" id="checklistModal"> 
 
            <div class="checklist-modal-conteudo"> 
 
                <button 
                    type="button" 
                    class="fechar-checklist" 
                    onclick="fecharChecklist()" 
                > 
 
                    <i class="fas fa-xmark"></i> 
 
                </button> 
 
 
                <div id="checklistConteudo"></div> 
 
            </div> 
 
        </div> 
 
 
        <!-- MODAL CONFIRMAÇÃO --> 
 
        <div class="confirmacao-modal" id="confirmacaoModal"> 
 
            <div class="confirmacao-caixa"> 
 
                <button 
                    type="button" 
                    class="fechar-confirmacao" 
                    onclick="fecharConfirmacao()" 
                > 
 
                    <i class="fas fa-xmark"></i> 
 
                </button> 
 
 
                <div class="confirmacao-icone"> 
                    <i class="fas fa-trash"></i> 
                </div> 
 
                <h3>Excluir registro?</h3> 
 
                <p> 
                    Tem certeza que deseja excluir este registro da sua trajetória? 
                    Essa ação não poderá ser desfeita. 
                </p> 
 
                <div class="confirmacao-botoes"> 
 
                    <button 
                        type="button" 
                        class="botao-cancelar" 
                        onclick="fecharConfirmacao()" 
                    > 
                        Cancelar 
                    </button> 
 
                    <a 
                        href="#" 
                        id="confirmarExclusao" 
                        class="botao-confirmar" 
                    > 
                        Excluir registro 
                    </a> 
 
                </div> 
 
            </div> 
 
        </div> 
 
 
 
        <!-- HISTÓRICO --> 
 
        <section class="registros-area"> 
 
            <div class="area-titulo"> 
 
                <div> 
                    <span>HISTÓRICO</span> 
                    <h2>Seus registros</h2> 
                </div> 
 
                <i class="fas fa-clock-rotate-left"></i> 
 
            </div> 
 
 
            <?php if ($registros->num_rows > 0): ?> 
 
                <div class="lista-registros"> 
 
                    <?php while ($registro = $registros->fetch_assoc()): ?> 
 
                        <article class="registro-card"> 
 
                            <div class="registro-data"> 
 
                                <strong> 
                                    <?php echo date("d/m", strtotime($registro["data_registro"])); ?> 
                                </strong> 
 
                                <span> 
                                    <?php echo date("Y", strtotime($registro["data_registro"])); ?> 
                                </span> 
 
                            </div> 
 
 
                            <div class="registro-conteudo"> 
 
                                <span class="registro-tipo"> 
                                    <?php echo htmlspecialchars($registro["tipo"]); ?> 
                                </span> 
 
                                <h3> 
                                    <?php echo htmlspecialchars($registro["titulo"]); ?> 
                                </h3> 
 
 
                                <?php if (!empty($registro["descricao"])): ?> 
 
                                    <p> 
                                        <?php echo nl2br(htmlspecialchars($registro["descricao"])); ?> 
                                    </p> 
 
                                <?php endif; ?> 
 
 
                                <div class="registro-detalhes"> 
 
                                    <?php if (!empty($registro["profissional"])): ?> 
 
                                        <span> 
 
                                            <i class="fas fa-user-doctor"></i> 
 
                                            <?php echo htmlspecialchars($registro["profissional"]); ?> 
 
                                        </span> 
 
                                    <?php endif; ?> 
 
 
                                    <?php if (!empty($registro["local"])): ?> 
 
                                        <span> 
 
                                            <i class="fas fa-location-dot"></i> 
 
                                            <?php echo htmlspecialchars($registro["local"]); ?> 
 
                                        </span> 
 
                                    <?php endif; ?> 
 
                                </div> 
 
                            </div> 
 
 
                            <a 
                                href="#" 
                                class="excluir-registro" 
                                onclick="abrirConfirmacao(<?php echo $registro["id"]; ?>); return false;" 
                                title="Excluir registro" 
                            > 
 
                                <i class="fas fa-trash"></i> 
 
                            </a> 
 
                        </article> 
 
                    <?php endwhile; ?> 
 
                </div> 
 
            <?php else: ?> 
 
                <div class="sem-registros"> 
 
                    <i class="fas fa-folder-open"></i> 
 
                    <h3>Nenhum registro ainda</h3> 
 
                    <p> 
                        Adicione seu primeiro registro para começar a organizar 
                        sua trajetória. 
                    </p> 
 
                </div> 
 
            <?php endif; ?> 
 
        </section> 
 
 
        <div class="privacidade-trajetoria"> 
 
            <i class="fas fa-lock"></i> 
 
            <div> 
 
                <strong>Seus registros são pessoais</strong> 
 
                <p> 
                    As informações adicionadas ficam vinculadas à sua conta 
                    e podem ser acessadas novamente quando você entrar no ForTEA. 
                </p> 
 
            </div> 
 
        </div> 
 
    </div> 
 
</section> 
 
</main> 
 
 
<script> 
 
const checklists = <?php echo json_encode($checklists, JSON_UNESCAPED_UNICODE); ?>; 
 
 
function abrirChecklist(id) { 
 
    const checklist = checklists.find(item => item.id == id); 
 
    if (!checklist) { 
        return; 
    } 
 
    let html = ` 
        <div class="modal-cabecalho"> 
 
            <div class="modal-icone"> 
                <i class="fas ${checklist.icone}"></i> 
            </div> 
 
            <div> 
                <span>CHECKLIST</span> 
                <h2>${checklist.titulo}</h2> 
                <p>${checklist.descricao}</p> 
            </div> 
 
        </div> 
 
 
        <div class="modal-progresso"> 
 
            <div class="modal-progresso-texto"> 
 
                <span class="texto-progresso"> 
                    ${checklist.concluidas} de ${checklist.total} concluídas 
                </span> 
 
                <strong class="porcentagem-progresso"> 
                    ${calcularPorcentagem(checklist)}% 
                </strong> 
 
            </div> 
 
 
            <div class="checklist-barra"> 
 
                <div 
                    class="barra-modal" 
                    style="width: ${calcularPorcentagem(checklist)}%;" 
                ></div> 
 
            </div> 
 
        </div> 
 
 
        <div class="itens-modal"> 
    `; 
 
 
    checklist.itens.forEach(item => { 
 
        html += ` 
            <button 
                type="button" 
                class="item-modal ${item.concluida == 1 ? "item-concluido" : ""}" 
                onclick="marcarItem(${item.id}, ${checklist.id})" 
            > 
 
                <span class="check-modal"> 
 
                    <i class="fas fa-check"></i> 
 
                </span> 
 
                <span> 
                    ${item.etapa} 
                </span> 
 
            </button> 
        `; 
 
    }); 
 
 
    html += `</div>`; 
 
 
    document.getElementById("checklistConteudo").innerHTML = html; 
 
    document.getElementById("checklistModal").classList.add("ativo"); 
 
    document.body.classList.add("modal-aberto"); 
} 
 
 
function fecharChecklist() { 
 
    document.getElementById("checklistModal").classList.remove("ativo"); 
 
    document.body.classList.remove("modal-aberto"); 
 
} 
 
 
function abrirConfirmacao(id) { 
 
    document.getElementById("confirmarExclusao").href = 
        "minha-trajetoria.php?excluir=" + id; 
 
    document.getElementById("confirmacaoModal").classList.add("ativo"); 
 
    document.body.classList.add("modal-aberto"); 
 
} 
 
 
function fecharConfirmacao() { 
 
    document.getElementById("confirmacaoModal").classList.remove("ativo"); 
 
    document.body.classList.remove("modal-aberto"); 
 
} 
 
 
function calcularPorcentagem(checklist) { 
 
    if (checklist.total == 0) { 
        return 0; 
    } 
 
    return Math.round( 
        (checklist.concluidas / checklist.total) * 100 
    ); 
 
} 
 
 
async function marcarItem(itemId, checklistId) { 
 
    const checklist = checklists.find(item => item.id == checklistId); 
 
    const item = checklist.itens.find(item => item.id == itemId); 
 
    const novoEstado = item.concluida == 1 ? 0 : 1; 
 
    try { 
 
        const resposta = await fetch("atualiza_checklist.php", { 
 
            method: "POST", 
 
            headers: { 
                "Content-Type": "application/x-www-form-urlencoded" 
            }, 
 
            body: 
                "item_id=" + encodeURIComponent(itemId) + 
                "&concluida=" + encodeURIComponent(novoEstado) 
 
        }); 
 
        const resultado = await resposta.text(); 
 
        if (resultado.trim() !== "ok") { 
            throw new Error("Não foi possível salvar."); 
        } 
 
        item.concluida = novoEstado; 
 
        checklist.concluidas = checklist.itens.filter( 
            item => item.concluida == 1 
        ).length; 
 
        abrirChecklist(checklistId); 
 
        atualizarCardChecklist(checklist); 
 
    } catch (erro) { 
 
        alert("Não foi possível salvar esta alteração. Tente novamente."); 
 
    } 
} 
 
 
function atualizarCardChecklist(checklist) { 
 
    const cards = document.querySelectorAll(".checklist-card"); 
 
    cards.forEach(card => { 
 
        const titulo = card.querySelector("h3"); 
 
        if (titulo.textContent.trim() == checklist.titulo) { 
 
            const texto = card.querySelector(".checklist-progresso-texto span"); 
 
            const porcentagem = card.querySelector(".checklist-progresso-texto strong"); 
 
            const barra = card.querySelector(".checklist-barra div"); 
 
 
            texto.textContent = 
                checklist.concluidas + 
                " de " + 
                checklist.total + 
                " concluídas"; 
 
            porcentagem.textContent = 
                calcularPorcentagem(checklist) + "%"; 
 
            barra.style.width = 
                calcularPorcentagem(checklist) + "%"; 
 
        } 
 
    }); 
 
} 
 
 
document.getElementById("checklistModal").addEventListener("click", function(event) { 
 
    if (event.target === this) { 
        fecharChecklist(); 
    } 
 
}); 
 
 
document.getElementById("confirmacaoModal").addEventListener("click", function(event) { 
 
    if (event.target === this) { 
        fecharConfirmacao(); 
    } 
 
}); 
 
</script> 
 
 
<?php include "includes/footer.php"; ?>