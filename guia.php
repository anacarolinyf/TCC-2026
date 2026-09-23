<?php

session_start();

require_once "conexao.php";

$checklists_concluidas = 0;
$total_checklists = 4;
$progresso_trajetoria = 0;

if (isset($_SESSION["usuario_id"])) {

    $usuario_id = $_SESSION["usuario_id"];

    $sql = "SELECT 
                c.id,
                COUNT(i.id) AS total_itens,
                SUM(i.concluida) AS itens_concluidos
            FROM trajetoria_checklists c
            LEFT JOIN trajetoria_itens i
                ON c.id = i.checklist_id
            WHERE c.usuario_id = ?
            GROUP BY c.id";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado_checklists = $stmt->get_result();

    $total_itens = 0;
    $total_concluidos = 0;

    while ($checklist = $resultado_checklists->fetch_assoc()) {

        $itens = (int) $checklist["total_itens"];
        $concluidos = (int) $checklist["itens_concluidos"];

        $total_itens += $itens;
        $total_concluidos += $concluidos;

        if ($itens > 0 && $itens == $concluidos) {
            $checklists_concluidas++;
        }
    }

    if ($total_itens > 0) {
        $progresso_trajetoria = round(
            ($total_concluidos / $total_itens) * 100
        );
    }

    $stmt->close();
}

?>


<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/estilo.css">

<main>

    <section class="guia-intro">
        <div class="guia-intro-texto">
            <span class="guia-tag">GUIA PARA FAMÍLIAS</span>

            <h1>Um caminho para entender, organizar e acompanhar cada etapa</h1>

            <p>
                Receber informações sobre o autismo pode trazer muitas dúvidas.
                Este espaço foi criado para ajudar a família a encontrar informações
                confiáveis e compreender melhor os próximos passos.
            </p>

            <div class="guia-info">
                <span><i class="fas fa-book-open"></i> Informação</span>
                <span><i class="fas fa-users"></i> Acompanhamento</span>
                <span><i class="fas fa-heart"></i> Acolhimento</span>
            </div>
        </div>

        <div class="guia-intro-destaque">
            <i class="fas fa-route"></i>
            <h3>Por onde começar?</h3>
            <p>
                Não é necessário entender tudo de uma vez. Comece pelas informações
                mais importantes para o momento da sua família e avance aos poucos.
            </p>
        </div>
    </section>


    <section class="guia-comeco">
        <div class="guia-titulo">
            <span>01</span>
            <div>
                <small>ANTES DE TUDO</small>
                <h2>Entender é o primeiro passo</h2>
            </div>
        </div>

        <div class="guia-comeco-grid">
            <div>
                <p>
                    O Transtorno do Espectro Autista (TEA) está relacionado ao
                    desenvolvimento neurológico e pode se apresentar de maneiras
                    diferentes em cada pessoa.
                </p>

                <p>
                    Por isso, não existe uma única forma de vivenciar o autismo.
                    Algumas pessoas podem precisar de mais apoio em determinadas
                    áreas, enquanto outras apresentam necessidades diferentes.
                </p>
            </div>

            <div class="guia-aviso">
                <i class="fas fa-circle-info"></i>
                <div>
                    <strong>Uma observação importante</strong>
                    <p>
                        A presença de um sinal isolado não significa que uma pessoa
                        seja autista. A avaliação deve ser realizada por profissionais
                        capacitados.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="guia-sinais">
        <div class="guia-cabecalho">
            <div>
                <span>02</span>
                <small>CONHEÇA ALGUMAS ÁREAS</small>
                <h2>O que pode ser observado?</h2>
            </div>
        </div>

        <div class="guia-sinais-lista">

            <article>
                <div class="numero">01</div>
                <div>
                    <h3>Comunicação e linguagem</h3>
                    <p>
                        Diferenças na comunicação verbal e não verbal, na compreensão
                        de mensagens ou na forma de expressar necessidades e interesses.
                    </p>
                </div>
            </article>

            <article>
                <div class="numero">02</div>
                <div>
                    <h3>Interação social</h3>
                    <p>
                        Pode haver diferenças na reciprocidade social, no contato
                        visual, nas interações e na maneira de estabelecer relações.
                    </p>
                </div>
            </article>

            <article>
                <div class="numero">03</div>
                <div>
                    <h3>Comportamentos e interesses</h3>
                    <p>
                        Alguns comportamentos podem ser repetitivos ou existir
                        interesses muito intensos e específicos.
                    </p>
                </div>
            </article>

            <article>
                <div class="numero">04</div>
                <div>
                    <h3>Processamento sensorial</h3>
                    <p>
                        Sons, luzes, texturas, cheiros e outros estímulos podem
                        ser percebidos de maneiras diferentes.
                    </p>
                </div>
            </article>

            <article>
                <div class="numero">05</div>
                <div>
                    <h3>Rotina e mudanças</h3>
                    <p>
                        Algumas pessoas podem preferir previsibilidade e apresentar
                        dificuldade diante de mudanças inesperadas.
                    </p>
                </div>
            </article>

            <article>
                <div class="numero">06</div>
                <div>
                    <h3>Coordenação e planejamento</h3>
                    <p>
                        Algumas pessoas podem apresentar diferenças relacionadas
                        à coordenação motora e ao planejamento de determinadas ações.
                    </p>
                </div>
            </article>

        </div>
    </section>

    <section class="guia-rotina">

    <div class="guia-rotina-intro">

        <div class="guia-rotina-numero">
            03
        </div>

        <div>
            <span>NO DIA A DIA</span>
            <h2>Pequenas mudanças podem fazer diferença</h2>

            <p>
                A rotina de cada pessoa é diferente. Algumas estratégias simples
                podem ajudar a tornar as atividades do dia a dia mais previsíveis,
                confortáveis e compreensíveis.
            </p>
        </div>

    </div>


    <div class="guia-rotina-conteudo">

        <div class="estrategia">

            <div class="estrategia-icone">
                <i class="fas fa-calendar-check"></i>
            </div>

            <div class="estrategia-texto">
                <span>01 · ORGANIZAÇÃO</span>

                <h3>Deixe a rotina mais previsível</h3>

                <p>
                    Manter horários, atividades e combinados de forma compreensível
                    pode ajudar a pessoa a saber o que esperar ao longo do dia.
                </p>
            </div>

        </div>


        <div class="estrategia">

            <div class="estrategia-icone">
                <i class="fas fa-arrows-rotate"></i>
            </div>

            <div class="estrategia-texto">
                <span>02 · MUDANÇAS</span>

                <h3>Antecipe o que puder</h3>

                <p>
                    Quando uma mudança for possível de prever, avisar com
                    antecedência pode facilitar a adaptação a uma nova situação.
                </p>
            </div>

        </div>


        <div class="estrategia">

            <div class="estrategia-icone">
                <i class="fas fa-comments"></i>
            </div>

            <div class="estrategia-texto">
                <span>03 · COMUNICAÇÃO</span>

                <h3>Observe como a pessoa se comunica</h3>

                <p>
                    A comunicação pode acontecer de diferentes maneiras. Observe
                    quais formas são mais confortáveis e compreensíveis para ela.
                </p>
            </div>

        </div>


        <div class="estrategia">

            <div class="estrategia-icone">
                <i class="fas fa-clock"></i>
            </div>

            <div class="estrategia-texto">
                <span>04 · TEMPO</span>

                <h3>Respeite o tempo necessário</h3>

                <p>
                    Algumas atividades podem exigir mais tempo, pausas ou adaptações.
                    O importante é considerar as necessidades individuais.
                </p>
            </div>

        </div>

    </div>


    <div class="guia-rotina-atencao">

        <div class="atencao-icone">
            <i class="fas fa-circle-info"></i>
        </div>

        <div>
            <span>UM CUIDADO IMPORTANTE</span>

            <h3>Nem toda estratégia funciona da mesma forma</h3>

            <p>
                Pessoas autistas possuem necessidades diferentes. Uma estratégia
                que ajuda uma pessoa pode não funcionar para outra. Por isso,
                observe, adapte e, quando necessário, procure orientação profissional.
            </p>
        </div>

    </div>

</section>

    <section class="guia-diagnostico">

        <div class="guia-diagnostico-intro">
            <span>04</span>
            <small>APÓS O DIAGNÓSTICO</small>
            <h2>O que pode vir depois?</h2>

            <p>
                O diagnóstico pode ser o início de uma nova etapa para a família.
                Ter informações organizadas ajuda a compreender necessidades,
                direitos e possibilidades de acompanhamento.
            </p>
        </div>

        <div class="guia-diagnostico-passos">

            <div>
                <strong>01</strong>
                <h3>Busque informação confiável</h3>
                <p>
                    Conheça melhor o TEA, seus direitos e as possibilidades de apoio.
                </p>
            </div>

            <div>
                <strong>02</strong>
                <h3>Conheça a equipe de apoio</h3>
                <p>
                    Dependendo das necessidades individuais, diferentes profissionais
                    podem participar do acompanhamento.
                </p>
            </div>

            <div>
                <strong>03</strong>
                <h3>Organize documentos e informações</h3>
                <p>
                    Guardar relatórios, avaliações, contatos e registros pode facilitar
                    o acompanhamento ao longo do tempo.
                </p>
            </div>

        </div>

    </section>


    <section class="guia-equipe">

        <div class="guia-equipe-texto">
            <small>REDE DE APOIO</small>
            <h2>Ninguém precisa organizar tudo sozinho.</h2>

            <p>
                A família pode contar com uma rede formada por profissionais,
                escola, serviços de saúde e outras pessoas de confiança.
                A comunicação entre esses espaços pode contribuir para um
                acompanhamento mais organizado.
            </p>

            <a href="materiais.php" class="guia-botao">
                Explorar materiais
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="guia-equipe-itens">

            <div>
                <i class="fas fa-stethoscope"></i>
                <span>Profissionais</span>
            </div>

            <div>
                <i class="fas fa-school"></i>
                <span>Escola</span>
            </div>

            <div>
                <i class="fas fa-people-roof"></i>
                <span>Família</span>
            </div>

            <div>
                <i class="fas fa-hand-holding-heart"></i>
                <span>Rede de apoio</span>
            </div>

        </div>

    </section>



<section class="trajetoria">

    <div class="container">

        <div class="trajetoria-cabecalho">

            <div>
                <span>ORGANIZAÇÃO E ACOMPANHAMENTO</span>
                <h2>Organize sua trajetória</h2>
            </div>

        </div>


        <div class="trajetoria-painel">

            <div class="trajetoria-painel-topo">

                <div class="trajetoria-titulo">

                    <div class="trajetoria-icone">
                        <i class="fas fa-route"></i>
                    </div>

                    <div>
                        <small>MINHA TRAJETÓRIA</small>
                        <h3>Registre o que acontece ao longo do caminho</h3>
                    </div>

                </div>


                <a href="minha-trajetoria.php" class="trajetoria-adicionar">

                    <i class="fas fa-plus"></i>

                    Adicionar registro

                </a>

            </div>


            <div class="trajetoria-corpo">

                <div class="trajetoria-info">

                    <div class="trajetoria-info-item">

                        <i class="fas fa-calendar-days"></i>

                        <div>

                            <strong>Datas importantes</strong>

                            <p>
                                Organize consultas, avaliações, reuniões e outros
                                acontecimentos importantes.
                            </p>

                        </div>

                    </div>


                    <div class="trajetoria-info-item">

                        <i class="fas fa-notes-medical"></i>

                        <div>

                            <strong>Acompanhamentos</strong>

                            <p>
                                Registre informações sobre diagnóstico, terapias,
                                profissionais e acompanhamentos.
                            </p>

                        </div>

                    </div>


                    <div class="trajetoria-info-item">

                        <i class="fas fa-school"></i>

                        <div>

                            <strong>Escola e rotina</strong>

                            <p>
                                Anote reuniões, observações, mudanças e situações
                                importantes do dia a dia.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="trajetoria-checklist">

                    <div class="checklist-topo">

                        <div>

                            <span>CHECKLISTS</span>

                            <h4>Acompanhe sua trajetória</h4>

                        </div>

                        <i class="fas fa-list-check"></i>

                    </div>


                    <div class="progresso-info">

                        <span>
                            <?php echo $checklists_concluidas; ?>
                            de
                            <?php echo $total_checklists; ?>
                            concluídas
                        </span>

                        <strong>
                            <?php echo $progresso_trajetoria; ?>%
                        </strong>

                    </div>


                    <div class="barra-progresso">

                        <div
                            style="width: <?php echo $progresso_trajetoria; ?>%;">
                        </div>

                    </div>


                    <a
                        href="minha-trajetoria.php"
                        class="checklist-link"
                    >

                        Ver minhas checklists

                        <i class="fas fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>


        <div class="trajetoria-nota">

            <i class="fas fa-lock"></i>

            <div>

                <strong>Seus registros ficam vinculados à sua conta</strong>

                <p>
                    Entre no ForTEA para registrar sua trajetória e acessar
                    essas informações novamente pelo seu perfil.
                </p>

            </div>

        </div>

    </div>

</section>

</main>

<?php include 'includes/footer.php'; ?>