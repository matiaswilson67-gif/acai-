<?php
include 'conexao.php';

function listarProdutos($conexao) {
    $stmt = $conexao->query("SELECT produto_id, nome, tipo, descricao FROM produtos ORDER BY nome ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$produtos = listarProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Ingredientes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Açaí-Express | Gerenciamento de Ingredientes</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Gerenciar  Ingredientes </h2>
        <a href="cadastro_produto.php" class="acao-btn edit-btn" style="margin-bottom: 15px; display: inline-block;">+ Novo Ingrediente</a>
        
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
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($produtos)): ?>
                <tr><td colspan="5" style="text-align:center;">Nenhum Ingrediente cadastrado.</td></tr>
            <?php else: ?>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['produto_id']) ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($produto['tipo'])) ?></td>
                    <td><?= htmlspecialchars($produto['descricao'] ?? '-') ?></td>
                    <td>
                        <a href="editar_produto.php?id=<?= $produto['produto_id'] ?>" class="acao-btn edit-btn">Editar</a>
                        <a href="deletar_produto.php?produto_id=<?= $produto['produto_id'] ?>" class="acao-btn delete-btn" onclick="return confirm('Excluir Ingrediente <?= $produto['nome'] ?>?')">Excluir</a>
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