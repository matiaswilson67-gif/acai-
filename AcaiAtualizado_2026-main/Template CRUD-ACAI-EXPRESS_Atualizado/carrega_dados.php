<?php

include 'conexao.php';

function carregarMedidas($conexao) {
    $stmt = $conexao->query("SELECT medida_id, tamanho_ml, valor_base, descricao FROM medidas ORDER BY tamanho_ml ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function carregarProdutosPorTipo($conexao, $Tipo) {
    $sql = "SELECT produto_id, nome FROM produtos WHERE Tipo = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$Tipo]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

