<?php
$host = 'localhost';
$port = '5432';
$dbname = 'sistema_clinico';
$user = 'postgres'; // ou seu usuário
$password = 'sua_senha'; // substitua pela sua senha real

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conectado com sucesso!";
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
