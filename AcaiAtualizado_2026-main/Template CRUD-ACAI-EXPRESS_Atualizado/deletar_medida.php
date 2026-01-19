<?php

include "conexao.php";



    $id = $_GET['medida_id'];
  

    $sql = "DELETE FROM medidas WHERE medida_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$id]);
    
    header("location: listar_medidas.php");
