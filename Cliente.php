<?php
require_once 'Conexao.php';
require_once 'conexao.php';

class Cliente {
    private $id;
    private $nome;
    private $idade;
    private $email;
    private $enderecoCobranca;
    private $enderecoEntrega;
    private $idUsuario;

    public function __construct($nome, $idade, $email, $idUsuario) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->email = $email;
        $this->idUsuario = $idUsuario;
    }

    public function setEnderecoCobranca($enderecoCobranca) {
        $this->enderecoCobranca = $enderecoCobranca;
    }

    public function setEnderecoEntrega($enderecoEntrega) {
        $this->enderecoEntrega = $enderecoEntrega;
    }

    public function salvar() {
        $conexao = new Conexao("localhost", "root", "Batata.2021", "api");
        $conn = $conexao->getConnection();

        $stmt = $conn->prepare("INSERT INTO clientes (nome, idade, email, endereco_cobranca, endereco_entrega, id_usuario) VALUES (:nome, :idade, :email, :enderecoCobranca, :enderecoEntrega, :idUsuario)");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':enderecoCobranca', $this->enderecoCobranca);
        $stmt->bindParam(':enderecoEntrega', $this->enderecoEntrega);
        $stmt->bindParam(':idUsuario', $this->idUsuario);
        $stmt->execute();

        $this->id = $conn->lastInsertId();
    }

    public function editar() {
        $conexao = new Conexao("localhost", "root", "Batata.2021", "api");
        $conn = $conexao->getConnection();

        $stmt = $conn->prepare("UPDATE clientes SET nome = :nome, idade = :idade, email = :email, endereco_cobranca = :enderecoCobranca, endereco_entrega = :enderecoEntrega WHERE id = :id AND id_usuario = :idUsuario");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':enderecoCobranca', $this->enderecoCobranca);
        $stmt->bindParam(':enderecoEntrega', $this->enderecoEntrega);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':idUsuario', $this->idUsuario);
        $stmt->execute();
    }

    public function excluir() {
        $conexao = new Conexao("localhost", "root", "Batata.2021", "api");
        $conn = $conexao->getConnection();
    
        $stmt = $conn->prepare("DELETE FROM clientes WHERE id = :id AND id_usuario = :idUsuario");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':idUsuario', $this->idUsuario);
    
        // Verifica a consulta SQL
        var_dump($stmt->queryString);
    
        $stmt->execute();
    }
    
    
}
?>
