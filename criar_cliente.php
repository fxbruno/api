<?php
require_once 'Cliente.php';
//require_once 'src/conexao.php';
require_once 'Conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtém os dados enviados via POST
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$enderecoCobranca = $_POST['endereco_cobranca'];
$enderecoEntrega = $_POST['endereco_entrega'];
$idUsuario = $_POST['id_usuario'];

// Cria um objeto Cliente e define os valores
$cliente = new Cliente($nome, $idade, $email, $idUsuario);
$cliente->setEnderecoCobranca($enderecoCobranca);
$cliente->setEnderecoEntrega($enderecoEntrega);

// Salva o cliente no banco de dados
try {
    $cliente->salvar();

    // Retorna uma resposta de sucesso
    $response = array(
        'status' => 'success',
        'message' => 'Cliente criado e salvo com sucesso!',
        
    );
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    $response = array(
        'status' => 'error',
        'message' => 'Erro ao criar o cliente: ' . $e->getMessage()
    );
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
