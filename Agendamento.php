<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html');
    exit;
}

require 'conexao.php';


if (empty($_POST['nome']) || empty($_POST['telefone']) || empty($_POST['cpf']) || empty($_POST['email']) || empty($_POST['consulta']) || empty($_POST['data']) || empty($_POST['hora'])) {
    die("Erro: Todos os campos do agendamento são obrigatórios. <a href='AgendamentoPage.html'>Voltar</a>");
}

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$consulta_id = $_POST['consulta']; 
$data = $_POST['data'];
$hora = $_POST['hora'];


$sql_paciente = "SELECT id FROM pacientes WHERE cpf = :cpf";
$stmt_paciente = $pdo->prepare($sql_paciente);
$stmt_paciente->bindParam(':cpf', $cpf);
$stmt_paciente->execute();

$paciente = $stmt_paciente->fetch(PDO::FETCH_ASSOC);

$paciente_id = null;
if ($paciente) {
   
    $paciente_id = $paciente['id'];
} else {
   
    $sql_insert_paciente = "INSERT INTO pacientes (nome, telefone, cpf, email) VALUES (:nome, :telefone, :cpf, :email)";
    $stmt_insert_paciente = $pdo->prepare($sql_insert_paciente);
    $stmt_insert_paciente->bindParam(':nome', $nome);
    $stmt_insert_paciente->bindParam(':telefone', $telefone);
    $stmt_insert_paciente->bindParam(':cpf', $cpf);
    $stmt_insert_paciente->bindParam(':email', $email);
    $stmt_insert_paciente->execute();
    $paciente_id = $pdo->lastInsertId();
}


$sql_agendamento = "INSERT INTO agendamentos (paciente_id, consulta_id, data_consulta, hora_consulta)
                    VALUES (:paciente_id, :consulta_id, :data_consulta, :hora_consulta)";
$stmt_agendamento = $pdo->prepare($sql_agendamento);
$stmt_agendamento->bindParam(':paciente_id', $paciente_id);
$stmt_agendamento->bindParam(':consulta_id', $consulta_id);
$stmt_agendamento->bindParam(':data_consulta', $data);
$stmt_agendamento->bindParam(':hora_consulta', $hora);

if ($stmt_agendamento->execute()) {
    echo "<h1>Agendamento Realizado com Sucesso!</h1>";
    echo "<p>Sua consulta foi agendada para o dia " . htmlspecialchars($data) . " às " . htmlspecialchars($hora) . ".</p>";
    echo "<a href='AgendamentoPage.html'>Fazer um novo agendamento</a><br>";
    echo "<a href='logout.php'>Sair</a>";
} else {
    echo "Erro ao agendar. Por favor, tente novamente. <a href='AgendamentoPage.html'>Voltar</a>";
}
?>
