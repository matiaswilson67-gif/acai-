<?php

include "conexao.php";

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $id = $_POST['produto_id'];
    $item = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE produtos SET nome = ?, descricao = ?, tipo =? WHERE produto_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$item, $descricao, $tipo, $id]);
    
    header("location: listar_produtos.php");
}