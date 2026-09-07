<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/projeto.css">

<main class="pagina-sobre">

    <section class="sobre-banner">

        <div class="banner-conteudo">

            <span class="banner-label">SOBRE O PROJETO</span>

            <h1>
                Informação que
                <strong>acolhe.</strong>
            </h1>

            <p>
                Um espaço criado para tornar o conhecimento sobre
                o Transtorno do Espectro Autista mais acessível,
                claro e próximo de quem precisa dele.
            </p>

        </div>

    </section>

    <section class="sobre-texto">

        <div class="texto-container">

            <div class="texto-introducao">

                <span class="texto-label">O ForTEA</span>

                <h2>
                    Informação também é
                    <strong>uma forma de acolher.</strong>
                </h2>

            </div>


            <div class="texto-corpo">

                <p>
                  O ForTEA nasceu da percepção de que encontrar informações confiáveis sobre o Transtorno do Espectro Autista nem sempre é simples. Para famílias, cuidadores e professores, principalmente após uma suspeita ou diagnóstico, surgem muitas dúvidas sobre o que fazer, onde buscar orientação e quais direitos e estratégias podem fazer parte da rotina.

                  Ao pesquisar sobre o tema, percebemos que muitas informações estão espalhadas por diferentes fontes ou são apresentadas por meio de uma linguagem muito técnica, dificultando o acesso de quem precisa compreender o assunto de forma clara e prática.

                  </p>
                  <p>
                Por isso, criamos o ForTEA: para reunir informações, orientações e materiais em um único espaço, com uma linguagem mais acessível e uma navegação simples. O projeto busca aproximar o conhecimento de quem está no dia a dia ao lado de uma pessoa com TEA, oferecendo conteúdos sobre direitos, educação, rotina, estímulos e diferentes situações que podem fazer parte dessa jornada.

                Mais do que desenvolver um site, nosso objetivo foi utilizar a tecnologia para transformar informação em uma ferramenta de apoio. Queremos contribuir para que famílias e profissionais se sintam mais orientados e preparados, ajudando a combater a desinformação e os estigmas relacionados ao autismo.
                </p>

            </div>

        </div>

    </section>

<section class="sobre-equipe">

    <div class="equipe-container">

        <div class="equipe-titulo">
            <span class="texto-label">Quem Somos</span>

            <h2>
                As mentes por trás do <strong>ForTEA</strong>
            </h2>

            <p class="equipe-descricao">
                Somos quatro estudantes do curso técnico em Informática para Internet
                da Etec Professora Maria Cristina Medeiros. A escolha do tema nasceu
                da nossa percepção sobre a necessidade de tornar as informações sobre
                o Transtorno do Espectro Autista mais acessíveis, organizadas e fáceis
                de compreender.

                Durante o desenvolvimento do projeto, percebemos que famílias,
                cuidadores e professores podem encontrar dificuldades para localizar
                orientações claras e confiáveis para situações do dia a dia.

                Foi a partir dessa necessidade que decidimos criar o
                <strong>ForTEA</strong> (Famílias Orientadas e Rede TEA), nosso Trabalho
                de Conclusão de Curso, utilizando a tecnologia como uma ferramenta
                de informação e apoio.
            </p>
        </div>

        <div class="equipe-fotos">

            <div class="equipe-membro">
                <div class="foto-redonda">
                    <img src="img/ana-beatriz.jpg" alt="Ana Beatriz Gilarde Portela">
                </div>
                <h3>Ana Beatriz Gilarde Portela</h3>
                <p class="membro-funcao">Desenvolvedora</p>
            </div>

            <div class="equipe-membro">
                <div class="foto-redonda">
                    <img src="img/ana-caroliny.jpg" alt="Ana Caroliny Fortes">
                </div>
                <h3>Ana Caroliny Fortes</h3>
                <p class="membro-funcao">Desenvolvedora</p>
            </div>

            <div class="equipe-membro">
                <div class="foto-redonda">
                    <img src="img/heloisa.jpeg" alt="Heloísa Lima Rodrigues">
                </div>
                <h3>Heloísa Lima Rodrigues</h3>
                <p class="membro-funcao">Desenvolvedora</p>
            </div>

            <div class="equipe-membro">
                <div class="foto-redonda">
                    <img src="img/isadora.jpg" alt="Isadora Ribeiro Jans">
                </div>
                <h3>Isadora Ribeiro Jans</h3>
                <p class="membro-funcao">Desenvolvedora</p>
            </div>

        </div>

    </div>

</section>  

</main>


<?php include 'includes/footer.php'; ?>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const elementos = document.querySelectorAll(
        ".sobre-texto, .sobre-equipe"
    );

    const observer = new IntersectionObserver(
        function (entradas) {
            entradas.forEach(function (entrada) {
                if (entrada.isIntersecting) {
                    entrada.target.classList.add("sobre-visivel");
                    observer.unobserve(entrada.target);
                }
            });
        },
        {
            threshold: 0.08
        }
    );

    elementos.forEach(function (elemento) {
        observer.observe(elemento);
    });

});
</script>