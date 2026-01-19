<?php
include 'conexao.php';

function listarProdutos($conexao) {
    $stmt = $conexao->query("SELECT medida_id, tamanho_ml, valor_base, descricao FROM medidas ORDER BY tamanho_ml ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$medidas = listarProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Açaí-Express | Gerenciamento de Produtos</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Gerenciar Produtos</h2>
        <a href="cadastro_medida.html" class="acao-btn edit-btn" style="margin-bottom: 15px; display: inline-block;">+ Novo Produto</a>
        
        <?php 
        if (isset($_GET['sucesso'])) {
            echo "<p style='color: green;'>Sucesso na operação!</p>";
        }
        if (isset($_GET['erro'])) {
            echo "<p style='color: red;'>Erro na operação: " . htmlspecialchars($_GET['erro']) . "</p>";
        }
        ?>

        <table class="tabela-produtos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tamanho</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($medidas)): ?>
                <tr><td colspan="5" style="text-align:center;">Nenhum produto cadastrado.</td></tr>
            <?php else: ?>
                <?php foreach ($medidas as $medida): ?>
                <tr>
                    <td><?= htmlspecialchars($medida['medida_id']) ?></td>
                    <td><?= htmlspecialchars($medida['tamanho_ml']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($medida['valor_base'])) ?></td>
                    <td><?= htmlspecialchars($medida['descricao'] ?? '-') ?></td>
                    <td>
                        <a href="editar_medidas.php?medida_id=<?= $medida['medida_id'] ?>" class="acao-btn edit-btn">Editar</a>
                        <a href="deletar_medida.php?medida_id=<?= $medida['medida_id'] ?>" class="acao-btn delete-btn" onclick="return confirm('Excluir Produto <?= $medida['descricao'] ?>?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2025 Açaí-Express.</p>
    </footer>
</body>
</html>