<?php 
session_start();
require 'db.php'; // Conexão com o banco de dados

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Busca setores do banco de dados
$setores = $pdo->query("SELECT * FROM setores")->fetchAll(PDO::FETCH_ASSOC);

// Adiciona um novo setor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['novo_setor'])) {
    $nome_setor = trim($_POST['nome_setor']);
    $descricao_setor = trim($_POST['descricao_setor']);
    
    if ($nome_setor && $descricao_setor) {
        $stmt = $pdo->prepare("INSERT INTO setores (nome, descricao) VALUES (:nome, :descricao)");
        $stmt->execute(['nome' => $nome_setor, 'descricao' => $descricao_setor]);
        header("Location: gerenciar_setores.php");
        exit;
    }
}

// Remove um setor
if (isset($_GET['remover_setor'])) {
    $id_setor = $_GET['remover_setor'];
    $stmt = $pdo->prepare("DELETE FROM setores WHERE id_setor = :id");
    $stmt->execute(['id' => $id_setor]);
    header("Location: gerenciar_setores.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Setores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gerenciar Setores</h1>

    <h2>Setores Existentes</h2>
    <ul>
        <?php foreach ($setores as $setor): ?>
            <li>
                <?php echo htmlspecialchars($setor['nome']); ?> - <?php echo htmlspecialchars($setor['descricao']); ?>
                <a href="?remover_setor=<?php echo $setor['id_setor']; ?>" onclick="return confirm('Tem certeza que deseja remover este setor?');">Remover</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Adicionar Novo Setor</h2>
    <form method="POST">
        <input type="text" name="nome_setor" placeholder="Nome do Setor" required>
        <textarea name="descricao_setor" placeholder="Descrição do Setor" required></textarea>
        <button type="submit" name="novo_setor">Adicionar Setor</button>
    </form>
    <a href="dashboard.php">Voltar ao Painel</a>
</body>
</html>
