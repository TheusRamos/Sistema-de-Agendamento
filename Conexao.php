<?php
$host = 'localhost';
$port = '5432';
$dbname = 'sistema_clinico';
$user = 'postgres'; 

$password = 'sua_senha'; 

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
