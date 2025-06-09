<?php

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html');
    exit;
}


require 'conexao.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$consulta_id = $_POST['consulta'];
$data = $_POST['data'];
$hora = $_POST['hora'];

// Verifica se o paciente já existe pelo CPF
$sql = "SELECT id FROM pacientes WHERE cpf = :cpf";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cpf', $cpf);
$stmt->execute();

$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($paciente) {
    $paciente_id = $paciente['id'];
} else {
    $sql = "INSERT INTO pacientes (nome, telefone, cpf, email) VALUES (:nome, :telefone, :cpf, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $paciente_id = $pdo->lastInsertId();
}

// Registrar o agendamento
$sql = "INSERT INTO agendamentos (paciente_id, consulta_id, data_consulta, hora_consulta)
        VALUES (:paciente_id, :consulta_id, :data_consulta, :hora_consulta)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':paciente_id', $paciente_id);
$stmt->bindParam(':consulta_id', $consulta_id);
$stmt->bindParam(':data_consulta', $data);
$stmt->bindParam(':hora_consulta', $hora);

if ($stmt->execute()) {
    echo "Agendamento realizado!";
} else {
    echo "Erro ao agendar.";
}
?>
