<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    echo "Usuário logado com ID: $userId";
} else {
    echo "Usuário não está logado" ;
}
?>
