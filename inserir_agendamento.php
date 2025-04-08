<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "agendamentos";

// Conectar ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pega os dados do formulário
$usuario_id = $_POST['usuario_id'];
$data_hora = $_POST['data_hora'];
$descricao = $_POST['descricao'];

// Prepara o SQL
$sql = "INSERT INTO agendamentos (usuario_id, data_hora, descricao) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $usuario_id, $data_hora, $descricao);

// Executa e verifica sucesso
if ($stmt->execute()) {
    echo "Agendamento feito com sucesso!";
} else {
    echo "Erro ao agendar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
