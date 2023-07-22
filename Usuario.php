<?php

class Usuario
{
    private $id;
    private $nome;
    private $senha;

    public function __construct($nome, $senha)
    {
        $this->nome = $nome;
        $this->senha = $senha;
    }

    // Getter para o ID
    public function getId()
    {
        return $this->id;
    }

    // Setter para o ID
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter para o nome
    public function getNome()
    {
        return $this->nome;
    }

    // Setter para o nome
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    // Getter para a senha
    public function getSenha()
    {
        return $this->senha;
    }

    // Setter para a senha
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}
