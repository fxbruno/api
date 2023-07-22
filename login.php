<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';
// Inicia a sessão
session_start();


// Obtém os dados de login enviados via POST
$nome = $_POST['nome'];
$senha = $_POST['senha'];


try {
    // Prepara a consulta SQL
    $sql = "SELECT id FROM usuarios WHERE nome = :nome AND senha = :senha";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha);

    // Executa a consulta
    $stmt->execute();

    // Verifica se o usuário foi encontrado
    if ($stmt->rowCount() > 0) {
        // Obtém o ID do usuário
        $id = $stmt->fetchColumn();

        // Inicia a sessão
        session_start();

        // Salva o ID do usuário na sessão
        $_SESSION['user_id'] = $id;

        // Retorna uma resposta de sucesso
        $response = array('status' => 'success', 'message' => 'Login bem-sucedido!', 'user_id' => $id);
    } else {
        // Usuário inválido, retorna uma resposta de erro
        $response = array('status' => 'error', 'message' => 'Nome de usuário ou senha inválidos!');
    }
} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    $response = array('status' => 'error', 'message' => 'Erro na consulta: ' . $e->getMessage());
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
