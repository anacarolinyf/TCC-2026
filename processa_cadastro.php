<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar"];

    if ($senha !== $confirmar) {
        die("As senhas não coincidem.");
    }

    // Verifica se o e-mail já existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        die("Este e-mail já está cadastrado.");
    }

    // Criptografa a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o usuário
    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

    if ($stmt->execute()) {

        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'login.php';
              </script>";

    } else {

        echo "Erro ao cadastrar: " . $conexao->error;
    }

    $stmt->close();
}

$conexao->close();

?>