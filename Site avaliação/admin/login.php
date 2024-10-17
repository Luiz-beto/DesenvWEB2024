<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: painel.php'); // Redireciona se já estiver logado
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica usuário e senha (simulação, substitua por consulta ao banco)
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    if ($usuario == 'admin' && $senha == '1217') { // Substitua pela lógica de autenticação real
        $_SESSION['usuario'] = $usuario;
        header('Location: painel.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
