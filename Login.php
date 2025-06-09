<?php

session_start();

require 'conexao.php';

if (empty($_POST['email']) || empty($_POST['senha'])) {
 
    header('Location: login.html?status=erro');
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, senha FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario['senha'])) {
   
    $_SESSION['usuario_id'] = $usuario['id'];
    header('Location: AgendamentoPage.html');
    exit;
} else {
   
    header('Location: login.html?status=erro');
    exit;
}
?>
