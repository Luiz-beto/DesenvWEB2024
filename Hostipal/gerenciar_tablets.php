<?php 
session_start();
require 'db.php'; // Conexão com o banco de dados

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Busca tablets do banco de dados
$tablets = $pdo->query("SELECT * FROM dispositivos")->fetchAll(PDO::FETCH_ASSOC);

// Adiciona um novo tablet
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['novo_tablet'])) {
    $nome_tablet = trim($_POST['nome_tablet']);
    if ($nome_tablet) {
        $stmt = $pdo->prepare("INSERT INTO dispositivos (nome, status) VALUES (:nome, 'ativo')");
        $stmt->execute(['nome' => $nome_tablet]);
        header("Location: gerenciar_tablets.php");
        exit;
    }
}

// Remove um tablet
if (isset($_GET['remover_tablet'])) {
    $id_tablet = $_GET['remover_tablet'];
    $stmt = $pdo->prepare("DELETE FROM dispositivos WHERE id_dispositivo = :id");
    $stmt->execute(['id' => $id_tablet]);
    header("Location: gerenciar_tablets.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tablets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gerenciar Tablets</h1>

    <h2>Tablets Existentes</h2>
    <ul>
        <?php foreach ($tablets as $tablet): ?>
            <li>
                <?php echo htmlspecialchars($tablet['nome']); ?> 
                <a href="?remover_tablet=<?php echo $tablet['id_dispositivo']; ?>" onclick="return confirm('Tem certeza que deseja remover este tablet?');">Remover</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Adicionar Novo Tablet</h2>
    <form method="POST">
        <input type="text" name="nome_tablet" placeholder="Nome do Tablet" required>
        <button type="submit" name="novo_tablet">Adicionar Tablet</button>
    </form>

    <a href="dashboard.php">Voltar ao Painel</a>
</body>
</html>
