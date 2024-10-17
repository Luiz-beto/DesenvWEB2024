<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redireciona se não estiver logado
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST['pergunta'];

    // Conexão com o banco de dados
    $conn = pg_connect("host=localhost dbname=seu_banco user=seu_usuario password=sua_senha");
    pg_query($conn, "INSERT INTO perguntas (texto) VALUES ('$pergunta')");
    header('Location: painel.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pergunta</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Cadastrar Pergunta</h1>
    <form method="POST">
        <input type="text" name="pergunta" placeholder="Digite a pergunta" required>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="painel.php">Voltar ao Painel</a>
</body>
</html>
