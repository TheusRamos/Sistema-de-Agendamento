<?php
include 'funcoes.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario_id = $_POST['usuario_id'];
    $nome = $_POST['nome'];
    $data_hora = $_POST['data_hora'];
    $consulta = $_POST['consulta'];
    $linha = $_POST['linha_terapeutica'] ?? 'Não informado';

    if (!validarNome($nome)) {
        echo "Nome inválido. Use apenas letras.";
        exit;
    }

    $dataFormatada = formatarDataHora($data_hora);

    echo "<h2>Dados recebidos:</h2>";
    echo "ID do Usuário: $usuario_id<br>";
    echo "Nome: $nome<br>";
    echo "Data e Hora: $dataFormatada<br>";
    echo "Tipo de Consulta: $consulta<br>";
    echo "Linha Terapêutica: $linha<br>";
}
?>