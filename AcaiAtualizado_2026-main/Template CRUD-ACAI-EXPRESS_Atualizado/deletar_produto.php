<?php

include "conexao.php";



    $id = $_GET['produto_id'];
  

    $sql = "DELETE FROM produtos WHERE produto_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$id]);
    
    header("location: listar_produtos.php");
