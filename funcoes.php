<?php
function validarNome($nome) {
    return preg_match("/^[a-zA-ZÀ-ú\s]+$/", $nome);
}
function formatarDataHora($dataHora) {
    return date('d/m/Y H:i', strtotime($dataHora));
}
?>