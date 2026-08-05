<?php include 'includes/header.php';?>

<link rel="stylesheet" href="css/estilo.css">

<main>

<section class="faq-banner">

    <div class="container">

        <div class="faq-topo">

            <div class="titulo">

                <h1><i class="fa-solid fa-circle-question"></i> FAQ – Perguntas frequentes</h1>

                <p>
                    Encontre respostas para as principais dúvidas sobre o Transtorno do Espectro Autista (TEA). Reunimos informações confiáveis e de fácil compreensão para ajudar você a entender melhor o diagnóstico, os direitos, o tratamento e o desenvolvimento da pessoa autista.
                </p>

            </div>



        </div>

            <div class="perguntas">
                <div class="accordion">

                    <button class="accordion-btn">
                        Como é feito o diagnóstico do autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
O diagnóstico do Transtorno do Espectro Autista (TEA) é realizado com muito cuidado, pois o transtorno pode se manifestar de diferentes formas em cada pessoa. Trata-se de um diagnóstico clínico, baseado na avaliação dos comportamentos, da comunicação, da interação social e do desenvolvimento do indivíduo. Em caso de dúvidas ou suspeitas, é fundamental procurar um profissional especializado o mais cedo possível.
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

</div> <!-- FECHA O CARD AQUI -->


<div class="accordion">

    <button class="accordion-btn">
        Todas as pessoas com Transtorno do Espectro Autista são iguais?
    </button>

    <div class="accordion-content">

        <p>
            Cada pessoa autista possui características, habilidades e necessidades
            diferentes. O espectro é amplo, por isso duas pessoas com TEA podem
            apresentar formas distintas de comunicação, comportamento e interação.
        </p>

    </div>

</div>
                <div class="accordion">

                    <button class="accordion-btn">
                        O que é comunicação alternativa no autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            tem que preencher
                        </p>
                    </div>
                </div>

                
                <div class="accordion">

                    <button class="accordion-btn">
                    O que é a hiperatividade em crianças com autismo?
                    </button>

                    <div class="accordion-content">

                        <p>
                            tem que preencher
                        </p>
                    </div>
                </div>

                 <div class="accordion">

                    <button class="accordion-btn">
                    Por que muitos não demonstram afeto?
                    </button>

                    <div class="accordion-content">

                        <p>
                            tem que preencher
                        </p>
                    </div>
                </div>

    <div class="accordion">
        <button class="accordion-btn">
                Autistas vivem de forma independente?        
            </button>
                    <div class="accordion-content">

                        <p>
                            tem que preencher
                        </p>
                    </div>
                </div>

</section>

</main>

<script>

const accordions = document.querySelectorAll(".accordion-btn");

accordions.forEach(btn=>{

    btn.addEventListener("click",()=>{

        accordions.forEach(other=>{

            if(other !== btn){

                other.classList.remove("active");
                other.nextElementSibling.style.maxHeight=null;

            }

        });


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