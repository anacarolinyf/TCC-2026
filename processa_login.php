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

            header("Location: index.php");
            exit;

        } else {

            echo "<script>
                    alert('Senha incorreta!');
                    window.location.href = 'login.php';
                  </script>";
        }

    } else {

        echo "<script>
                alert('E-mail não encontrado!');
                window.location.href = 'login.php';
              </script>";
    }

    $stmt->close();
    $conexao->close();
}

?>