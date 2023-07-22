<?php
require_once 'Conexao.php';

session_start();

// Verifica se o ID do cliente foi fornecido na requisição
if (!isset($_POST['id'])) {
    header('HTTP/1.0 400 Bad Request');
    echo 'ID do cliente não fornecido';
    exit;
}

$idCliente = $_POST['id'];
$userId = $_SESSION['user_id'];
echo "Usuário logado com ID: $userId";

// Cria a conexão com o banco de dados
$conexao = new Conexao("localhost", "root", "Batata.2021", "api");
$conn = $conexao->getConnection();

// Prepara e executa a consulta SQL para excluir o cliente
$stmt = $conn->prepare("DELETE FROM clientes WHERE id = :id AND id_usuario = :idUsuario");
$stmt->bindParam(':id', $idCliente);
$stmt->bindParam(':idUsuario', $userId);
$stmt->execute();

// Verifica se algum registro foi afetado
if ($stmt->rowCount() === 0) {
    header('HTTP/1.0 404 Not Found');
    echo 'Cliente não encontrado';
    exit;
}

// Retorna uma resposta de sucesso
$response = array('status' => 'success', 'message' => 'Cliente excluído com sucesso!');
header('Content-Type: application/json');
echo json_encode($response);
?>
