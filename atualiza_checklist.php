<?php

session_start();

require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    exit;
}

$usuario_id = $_SESSION["usuario_id"];

$item_id = intval($_POST["item_id"] ?? 0);
$concluida = intval($_POST["concluida"] ?? 0);

$sql = "UPDATE trajetoria_itens i
        INNER JOIN trajetoria_checklists c
        ON i.checklist_id = c.id
        SET i.concluida = ?
        WHERE i.id = ?
        AND c.usuario_id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param(
    "iii",
    $concluida,
    $item_id,
    $usuario_id
);

$stmt->execute();

echo "ok";

$stmt->close();
$conexao->close();

?>