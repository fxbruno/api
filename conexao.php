<?php

// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "Batata.2021";
$dbname = "api";

try {
    // Cria uma nova conexão PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configura o modo de erro para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
