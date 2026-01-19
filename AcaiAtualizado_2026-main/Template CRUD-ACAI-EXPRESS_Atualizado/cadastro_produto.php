<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto/Ingrediente</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <h1>Açaí-Express | Cadastrar Produto</h1>
        <nav>
            <a href="index.html" class="home-link"><i class="fas fa-house"></i> Início</a>
        </nav>
    </header>
    <div class="container">
        <h2>Adicionar Novo Produto/Ingrediente</h2>
        <form action="processa_produto.php" method="POST">
            <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
            <div>
                <label for="nome">Nome do Item:</label>
                <input type="text" id="nome" name="nome" required placeholder="Ex: Morango, Leite Condensado, Granola">
            </div>
            
            <div>
                <label for="tipo">Tipo de Item:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione o Tipo</option>
                    <option value="base">Açaí Base (Se tiver variações)</option>
                    <option value="fruta">Fruta</option>
                    <option value="cobertura">Cobertura (Calda)</option>
                    <option value="adicional">Adicional (Topping seco, Leite Ninho, etc.)</option>
                </select>
            </div>
            
            <div>
                <label for="descricao">Descrição (Opcional):</label>
                <input type="text" id="descricao" name="descricao" placeholder="Detalhes do item">
            </div>

            <div>
                <button type="submit">Salvar Produto</button>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2025 Açaí-Express.</p>
    </footer>
</body>

</html>