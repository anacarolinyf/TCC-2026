<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar"];

    // Verifica se as senhas são iguais
    if ($senha !== $confirmar) {
        header("Location: cadastro.php?erro=senhas");
        exit;
    }

    // Verifica se o e-mail já existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: cadastro.php?erro=email");
        exit;
    }

    // Criptografa a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o usuário
    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

    if ($stmt->execute()) {

    header("Location: login.php?cadastro=sucesso");
    exit;

} else {

    header("Location: cadastro.php?erro=geral");
    exit;
}

    $stmt->close();
}

$conexao->close();
?>

  <link
        rel="icon"
        type="image"
        href="img/logoo.png"
    >
