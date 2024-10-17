<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redireciona se não estiver logado
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_dispositivo = $_POST['nome_dispositivo'];
    $setor = $_POST['setor'];

    // Conexão com o banco de dados
    $conn = pg_connect("host=localhost dbname=seu_banco user=seu_usuario password=sua_senha");
    pg_query($conn, "INSERT INTO dispositivos (nome_dispositivo, setor) VALUES ('$nome_dispositivo', '$setor')");
    header('Location: painel.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Dispositivo</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Cadastrar Dispositivo</h1>
    <form method="POST">
        <input type="text" name="nome_dispositivo" placeholder="Nome do Dispositivo" required>
        <select name="setor" required>
            <option value="Recepção">Recepção</option>
            <option value="Enfermagem">Enfermagem</option>
            <option value="Emergência">Emergência</option>
            <option value="Alimentação">Alimentação</option>
        </select>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="painel.php">Voltar ao Painel</a>
</body>
</html>
