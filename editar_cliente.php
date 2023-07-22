<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'conexao.php';
require_once 'Cliente.php';

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo 'Batata';
    exit;
}
// Verifica se o ID do cliente foi fornecido na requisição
if (!isset($_POST['id'])) {
    header('HTTP/1.0 400 Bad Request');
    echo 'ID do cliente não fornecido';
    exit;
}

$idCliente = $_POST['id'];
$idUsuario = $_SESSION['user_id']; // Obtém o ID do usuário autenticado da sessão

// Verifica se o cliente existe e se pertence ao usuário autenticado
$conexao = new Conexao("localhost", "root", "Batata.2021", "api");
$conn = $conexao->getConnection();

$stmt = $conn->prepare("SELECT * FROM clientes WHERE id = :id AND id_usuario = :idUsuario");
$stmt->bindParam(':id', $idCliente);
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    header('HTTP/1.0 404 Not Found');
    echo 'Cliente não encontrado';
    exit;
}

// Obtém os dados enviados via POST
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$enderecoCobranca = $_POST['endereco_cobranca'];
$enderecoEntrega = $_POST['endereco_entrega'];

// Cria um objeto Cliente e define os dados atualizados
$clienteObj = new Cliente($nome, $idade, $email, $idUsuario);
$clienteObj->setEnderecoCobranca($enderecoCobranca);
$clienteObj->setEnderecoEntrega($enderecoEntrega);


// Edita o cliente
$clienteObj->editar();

// Retorna uma resposta de sucesso
$response = array('status' => 'success', 'message' => 'Cliente atualizado com sucesso!');
header('Content-Type: application/json');
echo json_encode($response);
?>
