<?php
session_start();
require 'db.php'; // Certifique-se de que este arquivo contém a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    // Busca o administrador no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuarios_admin WHERE login = :login");
    $stmt->execute(['login' => $usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha está correta
    if ($admin && password_verify($senha, $admin['senha'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['usuario'] = $admin['login'];
        header("Location: dashboard.php"); // Redireciona para a página do dashboard
        exit;
    } else {
        echo "<script>alert('Usuário ou senha incorretos!'); window.location.href='login.html';</script>";
    }
}
?>
