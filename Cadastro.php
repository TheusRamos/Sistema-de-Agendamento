<?php
require 'conexao.php';

// Validação básica dos dados recebidos
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    die("Erro: Todos os campos são obrigatórios.");
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// 1. Verificar se o e-mail já existe no banco
$sql_check = "SELECT id FROM usuarios WHERE email = :email";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->bindParam(':email', $email);
$stmt_check->execute();

if ($stmt_check->fetch()) {
    die("Erro: Este e-mail já está cadastrado. <a href='Cadastro.html'>Tente novamente</a>.");
}

// 2. Se não existir, criptografa a senha e insere o novo usuário
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt_insert = $pdo->prepare($sql_insert);
$stmt_insert->bindParam(':nome', $nome);
$stmt_insert->bindParam(':email', $email);
$stmt_insert->bindParam(':senha', $senha_hash);

if ($stmt_insert->execute()) {
    // Redireciona para a página de login após o sucesso
    header('Location: login.html?status=cadastrosucesso');
    exit;
} else {
    echo "Erro ao cadastrar. Por favor, tente novamente.";
}
?>
