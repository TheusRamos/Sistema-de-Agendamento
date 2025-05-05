<?php
if (isset($_GET['busca'])) {
  $busca = htmlspecialchars($_GET['busca']);
  echo "Você buscou pelo usuário: $busca";
}
?>