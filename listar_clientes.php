<?php
require_once 'conexao.php';
require_once 'Cliente.php';


// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo 'Acesso não autorizado';
    exit;
}

$idUsuario = $_SESSION['user_id'];

// Cria uma instância da classe Conexao
$conexao = new Conexao();

// Obtém a conexão com o banco de dados
$conn = $conexao->getConnection();

// Prepara a consulta SQL para obter os clientes do usuário
$stmt = $conn->prepare("SELECT * FROM clientes WHERE id_usuario = :idUsuario");
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->execute();

// Obtém os clientes do usuário
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retorna a resposta com os clientes e a ID do usuário
$response = array(
    'status' => 'success',
    'message' => 'Clientes listados com sucesso!',
    'idUsuario' => $idUsuario,
    'clientes' => $clientes
);

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
