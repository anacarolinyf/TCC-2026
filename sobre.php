<?php include 'includes/header.php';?>

<link rel="stylesheet" href="css/estilo.css">

<main>

<section class="sobre-banner">

    <div class="sobre-texto">

        <h1>Sobre o Transtorno do Espectro Autista</h1>

        <p>
            Conheça mais sobre o Transtorno do Espectro Autista, seus principais sinais, níveis de suporte, diagnóstico precoce e a importância da inclusão em todas as fases da vida. Compreender suas características é fundamental para promover um ambiente mais inclusivo e acolhedor para as pessoas autistas e suas famílias.
        </p>

    </div>

    <div class="sobre-imagem">
        <img src="img/familiasobre.png" alt="Família">
    </div>

</section>

<section class="conteudo-tea">

    <div class="menu-lateral">

        <h3>Conteúdo</h3>

        <a href="#oque">O que é o TEA?</a>
        <a href="#sinais">Primeiros sinais</a>
        <a href="#diagnostico">Diagnóstico precoce</a>
        <a href="#niveis">Níveis de suporte</a>

    </div>

    <div class="conteudo-principal">

        <section id="oque">
            <h2>O que é o TEA?</h2>

            <p>
              O Transtorno do Espectro Autista (TEA) é uma condição do
              <span class="tooltip-termo" onclick="toggleTooltip(this)">
                neurodesenvolvimento
                <span class="tooltip-text">
                  Processo de crescimento e organização do sistema nervoso, é responsável por moldar e estruturar as habilidades motoras, cognitivas, sensoriais, comunicativas e emocionais do indivíduo.
                </span>
              </span>
             que influencia a forma como a pessoa se comunica, interage socialmente e percebe o mundo ao seu redor.

            Cada pessoa autista é única, com suas próprias habilidades, características e necessidades.

O TEA acompanha o indivíduo ao longo da vida, fazendo parte da sua forma de compreender o mundo.

Com apoio, informação e inclusão, pessoas autistas podem desenvolver seu potencial, conquistar autonomia e ter qualidade de vida.
            </p>
        </section>

        <section id="sinais">
            <h2>Primeiros sinais</h2>
                <p>
                   Os sinais do TEA podem ser percebidos ainda nos primeiros anos de vida. Em alguns bebês, já no primeiro ano, enquanto em outras crianças eles se tornam mais evidentes entre 18 e 24 meses, quando os marcos de comunicação e interação social começam a se desenvolver.

Em alguns casos, pessoas com características mais leves podem não receber o diagnóstico na infância, sendo identificadas apenas mais tarde, já na vida escolar ou até na vida adulta. Por isso, o TEA pode se manifestar de formas diferentes ao longo do espectro.
Entre os principais sinais observados estão:
            
<section class="sinais-tea">

  <h2>Primeiros sinais</h2>

  <p>
    Os sinais do Transtorno do Espectro Autista (TEA) podem ser observados ainda nos primeiros anos de vida,
    variando de acordo com cada pessoa.
  </p>

  <h3>Comunicação e interação social</h3>
  <ul>
    <li>Dificuldade em manter contato visual e interagir socialmente</li>
    <li>Dificuldade em demonstrar ou compartilhar emoções</li>
    <li>Tendência ao isolamento social</li>
  </ul>

  <h3>Comunicação verbal</h3>
  <ul>
    <li>Atraso na fala ou perda de palavras já adquiridas</li>
    <li>Ecolalia (repetição de palavras ou frases)</li>
  </ul>

  <h3>Comportamento</h3>
  <ul>
    <li>Apego a rotinas e interesses restritos</li>
    <li>Movimentos repetitivos como balançar o corpo ou bater as mãos</li>
  </ul>

  <h3>Aspectos sensoriais</h3>
  <ul>
    <li>Sensibilidade a sons, luzes, texturas ou cheiros</li>
    <li>Seletividade alimentar</li>
  </ul>

</section>

        <section id="diagnostico">
            <h2>Diagnóstico precoce</h2>

            <p>
                O diagnóstico precoce permite acesso a intervenções,
                acompanhamento profissional e maior apoio à família.
            </p>
        </section>

        <section id="niveis">

            <h2>Níveis de suporte</h2>

            <div class="cards-niveis">

                <div class="nivel-card">
                    <h3>Nível 1</h3>
                    <p>Necessita de apoio.</p>
                </div>

                <div class="nivel-card">
                    <h3>Nível 2</h3>
                    <p>Necessita de apoio substancial.</p>
                </div>

                <div class="nivel-card">
                    <h3>Nível 3</h3>
                    <p>Necessita de apoio muito substancial.</p>
                </div>

            </div>

        </section>

    </div>

</section>

<script>
function toggleTooltip(el) {
  el.classList.toggle("active");
}

/* fecha tooltip ao clicar fora */
document.addEventListener("click", function (e) {
  const tooltips = document.querySelectorAll(".tooltip-termo");

  tooltips.forEach(t => {
    if (!t.contains(e.target)) {
      t.classList.remove("active");
    }
  });
});
</script>

</main>

<?php include 'includes/footer.php'; ?>