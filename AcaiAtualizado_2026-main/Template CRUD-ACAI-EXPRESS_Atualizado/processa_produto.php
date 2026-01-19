<?php

include "conexao.php";

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $id = $_POST['produto_id'];
    $item = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $sql = "insert into produtos(nome,descricao,tipo) values(?,?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$item, $descricao, $tipo]);
    
    header("location: listar_produtos.php");
}