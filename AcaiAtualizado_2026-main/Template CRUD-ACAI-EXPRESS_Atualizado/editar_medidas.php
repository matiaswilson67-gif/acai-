<?php
include 'conexao.php';

$medida_id = isset($_GET['medida_id']) ? (int)$_GET['medida_id'] : 0;
if ($medida_id === 0) {
    header("Location: editar_medidas.php?erro=" . urlencode("ID do produto não fornecido."));
    exit();
}

try {
    $sql = "SELECT medida_id, tamanho_ml, valor_base, descricao FROM medidas WHERE medida_id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $medida_id);
    $stmt->execute();
    $medida = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medida) {
        header("Location: listar_medidas.php?erro=" . urlencode("Produto não encontrado."));
        exit();
    }
} catch (PDOException $e) {
    die("Erro ao carregar dados para edição: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar medidas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Açaí-Express | Editar medidas</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Atualizar Medida ID: <?= $medida_id ?></h2>
        <form action="atualiza_medida.php" method="POST">
            <input type="hidden" name="medida_id" value="<?= $medida_id ?>">
            
            <div>
                <label for="tamanho_ml">Tamanho do Item:</label>
                <input type="text" id="tamanho_ml" name="tamanho_ml" value="<?= htmlspecialchars($medida['tamanho_ml']) ?>" required>
            </div>
            
            <div>
                <label for="valor_base">Valor do Item:</label>
                <input type="text" id="valor_base" name="valor_base" value="<?= htmlspecialchars($medida['valor_base']) ?>" required>
                    
                    
                </select>
            </div>
            
            <div>
                <label for="descricao">Descrição (Opcional):</label>
                <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($medida['descricao'] ?? '') ?>" placeholder="Detalhes do item">
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