<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redireciona se não estiver logado
    exit;
}

// Conexão com o banco de dados
$conn = pg_connect("host=localhost dbname=seu_banco user=seu_usuario password=sua_senha");

// Obtém as avaliações
$result = pg_query($conn, "SELECT * FROM avaliacoes");

// Calcula a média
$média = pg_query($conn, "SELECT AVG(pontuacao) AS media, (SELECT texto FROM perguntas WHERE id = avaliacoes.id_pergunta) AS pergunta FROM avaliacoes GROUP BY id_pergunta");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Painel Administrativo</h1>
    <h2>Avaliações</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Pergunta</th>
            <th>Pontuação</th>
        </tr>
        <?php while ($row = pg_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['id_pergunta'] ?></td>
            <td><?= $row['pontuacao'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Médias por Pergunta</h2>
    <table>
        <tr>
            <th>Pergunta</th>
            <th>Média</th>
        </tr>
        <?php while ($row = pg_fetch_assoc($média)) : ?>
        <tr>
            <td><?= $row['pergunta'] ?></td>
            <td><?= round($row['media'], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    <a href="cadastrar_pergunta.php">Cadastrar Pergunta</a>
    <a href="cadastrar_dispositivo.php">Cadastrar Dispositivo</a>
    <a href="logout.php">Logout</a>
</body>
</html>
