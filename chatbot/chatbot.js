/* =========================
   CHATBOT FORTEA
========================= */

const chatbotButton = document.getElementById("chatbotButton");
const chatbotBox = document.getElementById("chatbotBox");
const chatbotClose = document.getElementById("chatbotClose");

const chatbotForm = document.getElementById("chatbotForm");
const chatbotInput = document.getElementById("chatbotInput");
const chatbotMessages = document.getElementById("chatbotMessages");


// ABRIR
chatbotButton.addEventListener("click", function () {

    chatbotBox.classList.toggle("active");

});


// FECHAR
chatbotClose.addEventListener("click", function () {

    chatbotBox.classList.remove("active");

});


// ADICIONAR MENSAGEM
function addMessage(text, type) {

    const message = document.createElement("div");

    if (type === "user") {
        message.className = "user-message";
    } else {
        message.className = "bot-message";
    }

    message.innerHTML = text;

    chatbotMessages.appendChild(message);

    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}


// RESPOSTA
function getBotResponse(question) {

    const text = question.toLowerCase();


    if (
        text.includes("o que é o fortea") ||
        text.includes("fortea")
    ) {

        return `
            O <strong>ForTEA</strong> é uma plataforma criada para
            facilitar o acesso a informações relacionadas à inclusão,
            educação e direitos.
        `;

    }


    if (
        text.includes("educação") ||
        text.includes("inclusiva")
    ) {

        return `
            A <strong>Educação Inclusiva</strong> busca garantir que
            todos os estudantes tenham acesso à educação,
            respeitando suas necessidades e particularidades.
            <br><br>
            Você pode acessar a área de Educação Inclusiva
            pelo menu principal do site.
        `;

    }


    if (
        text.includes("direito") ||
        text.includes("direitos")
    ) {

        return `
            Na área de <strong>Direitos</strong> você encontra
            informações importantes sobre os direitos das pessoas
            com deficiência e suas famílias.
        `;

    }


    if (
        text.includes("biblioteca") ||
        text.includes("livro")
    ) {

        return `
            A <strong>Biblioteca</strong> reúne materiais e
            conteúdos que podem ajudar famílias, estudantes
            e profissionais.
        `;

    }


    if (
        text.includes("ajuda") ||
        text.includes("problema") ||
        text.includes("não consigo")
    ) {

        return `
            Claro! 😊
            <br><br>
            Tente explicar sua dúvida com um pouco mais de detalhes.
            Assim posso indicar a área do ForTEA mais adequada.
        `;

    }


    if (
        text.includes("olá") ||
        text.includes("ola") ||
        text.includes("oi")
    ) {

        return `
            Olá! 👋
            <br><br>
            Como posso ajudar você?
        `;

    }


    return `
        Ainda estou aprendendo sobre esse assunto. 😊
        <br><br>
        Você pode tentar perguntar sobre:
        <br>
        • Educação inclusiva
        <br>
        • Direitos
        <br>
        • Biblioteca
        <br>
        • ForTEA
    `;

}


// ENVIO DO FORMULÁRIO
chatbotForm.addEventListener("submit", function(event) {

    event.preventDefault();

    const question = chatbotInput.value.trim();

    if (question === "") {
        return;
    }


    // mensagem do usuário
    addMessage(question, "user");


    chatbotInput.value = "";


    // pequeno atraso para parecer uma conversa
    setTimeout(function() {

        const response = getBotResponse(question);

        addMessage(response, "bot");

    }, 500);

});


// BOTÕES DE OPÇÕES
document.querySelectorAll(".chatbot-options button")
.forEach(function(button) {

    button.addEventListener("click", function() {

        const question = this.dataset.question;

        addMessage(question, "user");

        setTimeout(function() {

            const response = getBotResponse(question);

            addMessage(response, "bot");

        }, 500);

    });

});