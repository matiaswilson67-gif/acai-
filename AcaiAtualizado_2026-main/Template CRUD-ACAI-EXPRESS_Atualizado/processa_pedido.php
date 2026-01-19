<?php

include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $cliente = $_POST['cliente_nome'];
    $mesa = $_POST['mesa'];
    $medida = $_POST['medida_id'];
    $observacoes = $_POST['observacoes'];

    // Ajustar aqui se o nome da tabela for diferente
    $sql = "INSERT INTO pedido (cliente_nome, mesa, medida_id, observacoes) VALUES (?,?,?,?)";

    $stmt = $conexao->prepare($sql); 
    $stmt->execute([$cliente, $mesa, $medida, $observacoes]);

    header("Location: cadastro_pedido.php");
    exit;
}
?>
