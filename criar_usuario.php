<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';

// Obtém os dados enviados via POST
$nome = $_POST['nome'];
$senha = $_POST['senha'];

try {
    // Verifica se o usuário já existe no banco de dados
    $sqlVerificaUsuario = "SELECT * FROM usuarios WHERE nome = :nome";
    $stmtVerificaUsuario = $conn->prepare($sqlVerificaUsuario);
    $stmtVerificaUsuario->bindParam(':nome', $nome);
    $stmtVerificaUsuario->execute();

    if ($stmtVerificaUsuario->rowCount() > 0) {
        // Usuário já existe, retorna uma resposta de erro
        $response = array('status' => 'error', 'message' => 'Usuário já existe!');
    } else {
        // Insere o novo usuário no banco de dados
        $sqlInserirUsuario = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
        $stmtInserirUsuario = $conn->prepare($sqlInserirUsuario);
        $stmtInserirUsuario->bindParam(':nome', $nome);
        $stmtInserirUsuario->bindParam(':senha', $senha);
        $stmtInserirUsuario->execute();

        // Retorna uma resposta de sucesso
        $response = array('status' => 'success', 'message' => 'Usuário criado com sucesso!');
    }
} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    $response = array('status' => 'error', 'message' => 'Erro ao criar usuário: ' . $e->getMessage());
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
