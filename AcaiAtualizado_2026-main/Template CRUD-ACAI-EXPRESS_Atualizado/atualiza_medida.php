<?php

include "conexao.php";

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $id = $_POST['medida_id'];
    $item = $_POST['tamanho_ml'];
    $valor = $_POST['valor_base'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE medidas SET tamanho_ml = ?, descricao = ?, valor_base=? WHERE medida_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$item, $descricao, $valor, $id]);
    
    header("location: listar_medidas.php");
}