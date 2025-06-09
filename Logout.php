<?php

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html');
    exit;
}


session_start();
session_unset();    // Remove todas as variáveis da sessão
session_destroy();  // Destrói a sessão

// Redireciona para a página de login após logout
header('Location: login.html');
exit;
?>
