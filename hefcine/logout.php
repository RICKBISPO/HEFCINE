<?php
// Inicializa a sessão
session_start();
 
// Remove tudo o que foi escrito na sessão
$_SESSION = array();
 
// Encerra a sessão.
session_destroy();
 
// Redireciona para a página de login
header("location: login.php");
exit;
?>