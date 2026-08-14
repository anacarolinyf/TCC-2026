<?php
include 'includes/header.php';


$enviado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome && $email && $assunto && $mensagem) {
        $enviado = true;
    }
}
?>

<main class="pagina-contato">

    <section class="contato-hero">

        <div class="contato-hero-inner">

            <span class="contato-label">
                ENTRE EM CONTATO
            </span>

            <h1>
                Estamos aqui para ouvir você
            </h1>

            <p>
                Tem alguma dúvida, sugestão ou precisa de mais informações?
                Entre em contato com a equipe ForTEA.
            </p>

        </div>

    </section>


    <section class="contato-area">

        <div class="contato-container">

            <div class="contato-grid">


                <!-- INFORMAÇÕES -->

                <div class="contato-info">

                    <h2>
                        Fale conosco
                    </h2>

                    <p>
                        O ForTEA foi criado para oferecer informação,
                        orientação e acolhimento. Sua mensagem é importante
                        para continuarmos construindo um espaço cada vez mais
                        acessível e útil para as famílias.
                    </p>


                    <div class="contato-item">

                        <div class="contato-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div class="contato-item-text">

                            <strong>E-mail</strong>

                            <span>
                                teatcc26@gmail.com
                            </span>

                        </div>

                    </div>


                    


                    <div class="contato-item">

                        <div class="contato-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div class="contato-item-text">

                            <strong>Localização</strong>

                            <span>
                                Ribeirão Pires - SP <br>
                                Etec Professora Maria Cristina Medeiros
                            </span>

                        </div>

                    </div>


                    <div class="contato-aviso">

                        <i class="fa-solid fa-circle-info"></i>

                        <p>
                            As informações enviadas pelo formulário serão
                            utilizadas apenas para responder à sua solicitação.
                        </p>

                    </div>

                </div>


                <!-- FORMULÁRIO -->

                <div class="contato-form">

                    <h2>
                        Envie uma mensagem
                    </h2>

                    <form method="POST" action="contato.php">


                        <div class="contato-field">

                            <label for="nome">
                                Nome
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                placeholder="Digite seu nome"
                                required
                            >

                        </div>


                        <div class="contato-field">

                            <label for="email">
                                E-mail
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Digite seu e-mail"
                                required
                            >

                        </div>


                        <div class="contato-field">

                            <label for="assunto">
                                Assunto
                            </label>

                            <input
                                type="text"
                                id="assunto"
                                name="assunto"
                                placeholder="Qual é o assunto?"
                                required
                            >

                        </div>


                        <div class="contato-field">

                            <label for="mensagem">
                                Mensagem
                            </label>

                            <textarea
                                id="mensagem"
                                name="mensagem"
                                placeholder="Digite sua mensagem..."
                                required
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="contato-button"
                        >
                            <i class="fa-solid fa-paper-plane"></i>
                            Enviar mensagem
                        </button>


                    </form>

                </div>


            </div>

        </div>

    </section>

</main>