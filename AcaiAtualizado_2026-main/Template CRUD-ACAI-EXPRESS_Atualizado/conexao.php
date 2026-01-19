<?php

// Configurações (Ajuste se necessário)
$host = 'localhost';
$db   = 'acai_express_db'; // Substitua pelo seu banco
$user = 'root';
$pass = ''; // Padrão XAMPP

// DSN (Data Source Name) - OBRIGATÓRIO
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
     // Tenta conectar
     $conexao = new PDO($dsn, $user, $pass);
    // echo "Conexão PDO estabelecida com sucesso!";

} catch (\PDOException $e) {
     // Se houver erro, mostra a mensagem
     die("Erro de conexão PDO: " . $e->getMessage());
}
?>