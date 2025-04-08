<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "agendamentos";


$conn = new mysqli($host, $usuario, $senha, $banco);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$usuario_id = $_POST['usuario_id'];
$data_hora = $_POST['data_hora'];
$nome = $_POST['nome'];
$descricao = $_POST['consulta'];


$sql = "INSERT INTO agendamentos (usuario_id, data_hora, nome, descricao)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $usuario_id, $data_hora, $nome, $descricao);


if ($stmt->execute()) {
    echo "Agendamento feito com sucesso!";
} else {
    echo "Erro ao agendar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
