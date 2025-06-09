<?php
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario['senha'])) {
    session_start();
    $_SESSION['usuario_id'] = $usuario['id'];
    header('Location: Agendamento.html');
    exit;
} else {
    echo "Email ou senha inválidos.";
}
?>
