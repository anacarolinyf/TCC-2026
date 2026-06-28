<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ForTEA - Projeto</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter', sans-serif;
}

body{
    background:#f7f9fc;
    color:#1e293b;
    overflow-x:hidden;
}

/* FUNDO DECORATIVO */
body::before{
    content:"FORTEA";
    position:fixed;
    font-size:10rem;
    font-weight:700;
    color:rgba(30,58,138,0.04);
    top:40%;
    left:50%;
    transform:translate(-50%,-50%);
    z-index:0;
    letter-spacing:10px;
}

/* HEADER */
header{
    position:fixed;
    top:0;
    width:100%;
    background:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 8%;
    box-shadow:0 2px 20px rgba(0,0,0,0.05);
    z-index:10;
}

.logo{
    font-weight:700;
    color:#1e3a8a;
    font-size:18px;
}

nav a{
    margin-left:20px;
    text-decoration:none;
    color:#334155;
    font-weight:500;
    font-size:14px;
}

nav a:hover{
    color:#1e3a8a;
}

/* HERO */
.hero{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:140px 8% 80px;
    gap:40px;
}

.hero-text{
    max-width:600px;
}

.hero-text span{
    color:#2563eb;
    font-weight:600;
    font-size:14px;
    letter-spacing:1px;
}

.hero-text h1{
    font-size:42px;
    margin:15px 0;
    line-height:1.2;
}

.hero-text h1 span{
    color:#2563eb;
}

.hero-text p{
    color:#475569;
    font-size:16px;
    margin-bottom:25px;
}

.btn{
    display:inline-block;
    background:#2563eb;
    color:white;
    padding:12px 22px;
    border-radius:10px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.btn:hover{
    background:#1e40af;
    transform:translateY(-2px);
}

/* HERO IMAGE */
.hero-box{
    width:420px;
    height:320px;
    background:linear-gradient(135deg,#dbeafe,#eff6ff);
    border-radius:25px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#1e3a8a;
    font-weight:600;
    position:relative;
}

/* TIMELINE */
.section{
    padding:80px 8%;
    position:relative;
    z-index:1;
}

.section h2{
    text-align:center;
    font-size:28px;
    margin-bottom:50px;
}

.timeline{
    display:flex;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
}

.step{
    flex:1;
    min-width:220px;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    transition:0.3s;
}

.step:hover{
    transform:translateY(-5px);
}

.step h3{
    color:#1e3a8a;
    margin-bottom:10px;
}

/* PILARES */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    margin-bottom:10px;
    color:#2563eb;
}

/* FRASE */
.quote{
    background:#eaf2ff;
    padding:40px;
    border-radius:20px;
    text-align:center;
    font-size:18px;
    margin-top:60px;
}

/* CTA */
.cta{
    text-align:center;
    margin-top:60px;
}

.cta a{
    font-size:16px;
    padding:14px 26px;
}

/* RESPONSIVO */
@media(max-width:900px){
    .hero{
        flex-direction:column;
        text-align:center;
    }

    .hero-box{
        width:100%;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">FORTEA</div>
    <nav>
        <a href="#">Início</a>
        <a href="#">Guia</a>
        <a href="#">Direitos</a>
        <a href="#">Projeto</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <span>NOSSO PROJETO</span>
        <h1>Mais que um projeto, <span>uma rede de apoio</span></h1>
        <p>
            O ForTEA nasceu do desejo de transformar realidades através da informação,
            do acolhimento e da união entre famílias que convivem com o TEA.
        </p>
        <a class="btn" href="#">Conheça nossa história</a>
    </div>

    <div class="hero-box">
        Espaço de destaque visual
    </div>
</section>

<section class="section">
    <h2>Como tudo começou</h2>

    <div class="timeline">
        <div class="step">
            <h3>Identificação</h3>
            <p>Percebemos a dificuldade das famílias em encontrar informação clara.</p>
        </div>

        <div class="step">
            <h3>Conversa</h3>
            <p>Iniciamos diálogos e entendemos a necessidade de apoio real.</p>
        </div>

        <div class="step">
            <h3>Criação</h3>
            <p>Idealizamos um espaço acessível, acolhedor e informativo.</p>
        </div>

        <div class="step">
            <h3>ForTEA</h3>
            <p>Nasce a rede de apoio para famílias e pessoas com TEA.</p>
        </div>
    </div>
</section>

<section class="section">
    <h2>Nossos pilares</h2>

    <div class="cards">
        <div class="card">
            <h3>Acolhimento</h3>
            <p>Escutar, compreender e caminhar junto com cada família.</p>
        </div>

        <div class="card">
            <h3>Informação</h3>
            <p>Conteúdo claro, confiável e acessível para todos.</p>
        </div>

        <div class="card">
            <h3>Empatia</h3>
            <p>Se colocar no lugar do outro com respeito e sensibilidade.</p>
        </div>

        <div class="card">
            <h3>Inclusão</h3>
            <p>Construir uma sociedade mais justa e acessível.</p>
        </div>
    </div>

    <div class="quote">
        “Por meio da informação e do apoio mútuo, é possível promover mais qualidade de vida,
        inclusão e respeito às pessoas com TEA e suas famílias.”
    </div>

    <div class="cta">
        <a class="btn" href="#">Acesse o Guia para Famílias →</a>
    </div>
</section>

</body>
</html>