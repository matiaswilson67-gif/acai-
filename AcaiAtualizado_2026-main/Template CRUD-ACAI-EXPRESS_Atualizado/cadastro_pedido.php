<?php
include 'conexao.php';
include 'carrega_dados.php';

try {
    $medidas = carregarMedidas($conexao);
    $frutas = carregarProdutosPorTipo($conexao, 'Fruta');
    $coberturas = carregarProdutosPorTipo($conexao, 'cobertura');
    $adicionais = carregarProdutosPorTipo($conexao, 'adicional');
} catch (PDOException $e) {
    die("Erro ao carregar ingredientes: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Pedido</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Açaí-Express | Novo Pedido</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Montar e Registrar Pedido</h2>
        <form action="processa_pedido.php" method="POST">
            <div>
                <label for="cliente_nome">Nome do Cliente:</label>
                <input type="text" id="cliente_nome" name="cliente_nome" required>
            </div>
            <div>
                <label for="mesa">Mesa/Comanda:</label>
                <input type="number" id="mesa" name="mesa" required min="1" placeholder="Ex: 1, 10, Balcão">
            </div>
            <div>
                <label for="medida_id">Tamanho da Tigela (Medida):</label>
                <select id="medida_id" name="medida_id" required>
                    <option value="">Selecione o Tamanho</option>
                    <?php
                    foreach ($medidas as $medida) {
                        echo "<option value=\"{$medida['medida_id']}\">{$medida['tamanho_ml']}ml ({$medida['descricao']})</option>";
                    }
                    ?>
                </select>
            </div>

            <hr style="margin: 30px 0; border-top: 1px solid var(--cor-borda);">
            
            <h3>Selecione os Ingredientes do Açaí</h3>

            <div class="ingrediente-grupo">
                <label>Frutas (Máximo 2):</label>
                <?php
                for ($i = 1; $i <= 2; $i++) {
                    echo "<select name=\"fruta_{$i}\" style=\"margin-top: " . ($i > 1 ? '10px' : '0') . ";\">";
                    echo "<option value=\"\">Fruta {$i} (Opcional)</option>";
                    foreach ($frutas as $fruta) {
                        echo "<option value=\"{$fruta['produto_id']}\">{$fruta['nome']}</option>";
                    }
                    echo '</select>';
                }
                ?>
            </div>

            <div class="ingrediente-grupo">
                <label for="cobertura_id">Cobertura/Calda (Máximo 1):</label>
                <select id="cobertura_id" name="cobertura_id">
                    <option value="">Nenhuma (Opcional)</option>
                    <?php
                    foreach ($coberturas as $cobertura) {
                        echo "<option value=\"{$cobertura['produto_id']}\">{$cobertura['nome']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="ingrediente-grupo">
                <label>Adicionais (Máximo 4):</label>
                <?php
                for ($i = 1; $i <= 4; $i++) {
                    echo "<select name=\"adicional_{$i}\" style=\"margin-top: " . ($i > 1 ? '10px' : '0') . ";\">";
                    echo "<option value=\"\">Adicional {$i} (Opcional)</option>";
                    foreach ($adicionais as $adicional) {
                        echo "<option value=\"{$adicional['produto_id']}\">{$adicional['nome']}</option>";
                    }
                    echo '</select>';
                }
                ?>
            </div>
            
            <hr style="margin: 30px 0; border-top: 1px solid var(--cor-borda);">

            <div>
                <label for="observacoes">Observações do Pedido:</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Ex: Sem gelo, embalar para viagem, etc."></textarea>
            </div>

            <div>
                <button type="submit">Finalizar Pedido (CREATE)</button>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2025 Açaí-Express.</p>
    </footer>
</body>
</html>