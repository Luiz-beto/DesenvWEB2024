<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: index.html"); // Redireciona para a página de login
exit;
?>
