<?php

session_start();

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    $sql = "SELECT id, nome, email, senha
            FROM usuarios
            WHERE email = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario["senha"])) {

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nome"] = $usuario["nome"];
            $_SESSION["usuario_email"] = $usuario["email"];

            // Login correto → vai para a página inicial com animação
            header("Location: index.php?entrada=1");
            exit;

        } else {

            // Senha incorreta
            header("Location: login.php?erro=senha");
            exit;
        }

    } else {

        // E-mail não encontrado
        header("Location: login.php?erro=email");
        exit;
    }

    $stmt->close();
    $conexao->close();
}

?>