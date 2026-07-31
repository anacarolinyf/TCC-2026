<?php include 'includes/header.php';?>

<link rel="stylesheet" href="css/estilo.css">

<main>

<section class="faq-banner">

    <div class="container">

        <div class="faq-topo">

            <div class="titulo">

                <h1>FAQ – Perguntas frequentes</h1>

                <p>
                    Tire suas dúvidas sobre o Transtorno do Espectro Autista (TEA).
                </p>

            </div>


        </div>

        <div class="faq-conteudo">

            <aside class="categorias">

                <button class="ativo">Todas</button>

                <button>Sobre o TEA</button>

                <button>Diagnóstico</button>

                <button>Tratamento</button>

                <button>Comportamento</button>

                <button>Inclusão</button>

                <button>Direitos</button>

            </aside>

            <div class="perguntas">

                <div class="accordion">

                    <button class="accordion-btn">
                        O que é autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            O Transtorno do Espectro Autista (TEA) é uma condição do
                            neurodesenvolvimento que afeta principalmente a comunicação,
                            interação social e comportamento. Cada pessoa apresenta
                            características e necessidades diferentes.
                        </p>

                    </div>

                </div>

                <div class="accordion">

                    <button class="accordion-btn">
                        Como é feito o diagnóstico do autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            O diagnóstico é realizado por profissionais especializados
                            através da observação clínica, entrevistas e avaliações do
                            desenvolvimento da criança.
                        </p>

                    </div>

                </div>

                <div class="accordion">

                    <button class="accordion-btn">
                        Autismo tem cura?
                    </button>

                    <div class="accordion-content">

                        <p>
                            O autismo não possui cura, porém o acompanhamento adequado,
                            terapias e suporte podem promover maior autonomia e qualidade
                            de vida.
                        </p>

                    </div>

                </div>

                <div class="accordion">

                    <button class="accordion-btn">
                        Como é o tratamento do autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            O tratamento é individualizado e pode envolver psicologia,
                            fonoaudiologia, terapia ocupacional, psicopedagogia e outras
                            abordagens conforme as necessidades de cada pessoa.
                        </p>

                    </div>

                </div>

                <div class="accordion">

                    <button class="accordion-btn">
                        O autismo passa com o tempo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            Não. O autismo acompanha a pessoa durante toda a vida, mas
                            com apoio adequado é possível desenvolver habilidades e
                            conquistar maior independência.
                        </p>

                    </div>

                </div>

                <div class="accordion">

                    <button class="accordion-btn">
                        O autismo é somente em crianças?
                    </button>

                    <div class="accordion-content">

                        <p>
                            Não. O TEA acompanha a pessoa durante toda a vida. Adultos
                            também podem receber diagnóstico e acompanhamento.
                        </p>

                    </div>

                </div>

            </div>

            <div class="faq-imagem">

                <img src="../img/faq-ilustracao.png" alt="FAQ">

            </div>

        </div>

    </div>

</section>

</main>

<script>

const accordions = document.querySelectorAll(".accordion-btn");

accordions.forEach(btn=>{

    btn.addEventListener("click",()=>{

        btn.classList.toggle("active");

        let content = btn.nextElementSibling;

        if(content.style.maxHeight){

            content.style.maxHeight=null;

        }else{

            content.style.maxHeight=content.scrollHeight+"px";

        }

    });

});

</script>
<?php include 'includes/footer.php'; ?>