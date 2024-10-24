<?php 
session_start();
require 'db.php'; // Conexão com o banco de dados

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Busca os administradores no banco de dados
$admins = $pdo->query("SELECT * FROM usuarios_admin")->fetchAll(PDO::FETCH_ASSOC);

// Adiciona um novo administrador
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['novo_admin'])) {
    $login = trim($_POST['login']);
    $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT); // Hash da senha para segurança
    
    if ($login && $senha) {
        $stmt = $pdo->prepare("INSERT INTO usuarios_admin (login, senha) VALUES (:login, :senha)");
        $stmt->execute(['login' => $login, 'senha' => $senha]);
        header("Location: gerenciar_admins.php");
        exit;
    }
}

// Remove um administrador
if (isset($_GET['remover'])) {
    $id_usuario = $_GET['remover'];
    $stmt = $pdo->prepare("DELETE FROM usuarios_admin WHERE id_usuario = :id");
    $stmt->execute(['id' => $id_usuario]);
    header("Location: gerenciar_admins.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Administradores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gerenciar Administradores</h1>

    <h2>Adicionar Novo Administrador</h2>
    <form method="POST">
        <input type="text" name="login" placeholder="Login do Administrador" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="novo_admin">Adicionar Administrador</button>
    </form>

    <h2>Administradores Existentes</h2>
    <ul>
        <?php foreach ($admins as $admin): ?>
            <li>
                <?php echo htmlspecialchars($admin['login']); ?>
                <a href="?remover=<?php echo $admin['id_usuario']; ?>" onclick="return confirm('Tem certeza que deseja remover este administrador?');">Remover</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="dashboard.php">Voltar ao Painel</a>
</body>
</html>
