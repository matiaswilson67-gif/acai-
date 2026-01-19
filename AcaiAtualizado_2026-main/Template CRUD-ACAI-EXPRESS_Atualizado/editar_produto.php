<?php
include 'conexao.php';

$produto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($produto_id === 0) {
    header("Location: listar_produtos.php?erro=" . urlencode("ID do produto não fornecido."));
    exit();
}

try {
    $sql = "SELECT produto_id, nome, descricao, tipo FROM produtos WHERE produto_id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $produto_id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        header("Location: listar_produtos.php?erro=" . urlencode("Produto não encontrado."));
        exit();
    }
    $tipos = ['base', 'fruta', 'cobertura', 'adicional'];
} catch (PDOException $e) {
    die("Erro ao carregar dados para edição: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Açaí-Express | Editar Produto</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Atualizar Produto ID: <?= $produto_id ?></h2>
        <form action="atualiza_produto.php" method="POST">
            <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
            
            <div>
                <label for="nome">Nome do Item:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
            </div>
            
            <div>
                <label for="tipo">Tipo de Item:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione o Tipo</option>
                    <?php
                    foreach ($tipos as $tipo) {
                        $selected = ($tipo === $produto['tipo']) ? 'selected' : '';
                        $display_name = ucfirst(str_replace('_', ' ', $tipo));
                        echo "<option value=\"{$tipo}\" {$selected}>{$display_name}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <label for="descricao">Descrição (Opcional):</label>
                <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($produto['descricao'] ?? '') ?>" placeholder="Detalhes do item">
            </div>

            <div>
                <button type="submit">Salvar Alterações (UPDATE)</button>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2025 Açaí-Express.</p>
    </footer>
</body>
</html>