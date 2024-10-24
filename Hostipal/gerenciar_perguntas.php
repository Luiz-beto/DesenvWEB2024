<?php 
session_start();
require 'db.php'; // Inclua a conexão com o banco de dados

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html"); // Redireciona para o login se não estiver autenticado
    exit;
}

// Inicializa um array de perguntas
$perguntas = [];

// Busca perguntas do banco de dados
$stmt = $pdo->query("SELECT * FROM perguntas");
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca dispositivos e setores do banco de dados
$dispositivos = $pdo->query("SELECT * FROM dispositivos")->fetchAll(PDO::FETCH_ASSOC);
$setores = $pdo->query("SELECT * FROM setores")->fetchAll(PDO::FETCH_ASSOC);

// Adiciona uma nova pergunta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nova_pergunta'])) {
    $nova_pergunta = trim($_POST['nova_pergunta']);
    
    if ($nova_pergunta) {
        // Adiciona a pergunta ao banco de dados (sem id_setor e id_dispositivo)
        $stmt = $pdo->prepare("INSERT INTO perguntas (texto, status) VALUES (:texto, 'ativa')");
        $stmt->execute(['texto' => $nova_pergunta]);
        header("Location: gerenciar_perguntas.php"); // Redireciona após adicionar
        exit;
    }
}

// Remove uma pergunta
if (isset($_GET['remover'])) {
    $id_pergunta = $_GET['remover'];
    // Remove a pergunta do banco de dados
    $stmt = $pdo->prepare("DELETE FROM perguntas WHERE id_pergunta = :id");
    $stmt->execute(['id' => $id_pergunta]);
    header("Location: gerenciar_perguntas.php"); // Redireciona após remover
    exit;
}

// Atualiza uma pergunta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_pergunta'])) {
    $index = $_POST['index'];
    $pergunta_editada = trim($_POST['editar_pergunta']);
    if ($pergunta_editada) {
        // Atualiza a pergunta no banco de dados
        $stmt = $pdo->prepare("UPDATE perguntas SET texto = :texto WHERE id_pergunta = :id");
        $stmt->execute(['texto' => $pergunta_editada, 'id' => $index]);
        header("Location: gerenciar_perguntas.php"); // Redireciona após editar
        exit;
    }
}

// Ativa ou desativa uma pergunta
if (isset($_GET['toggle'])) {
    $id_pergunta = $_GET['toggle'];
    // Recupera o status atual da pergunta
    $stmt = $pdo->prepare("SELECT status FROM perguntas WHERE id_pergunta = :id");
    $stmt->execute(['id' => $id_pergunta]);
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($pergunta) {
        $novo_status = ($pergunta['status'] === 'ativa') ? 'inativa' : 'ativa';
        // Atualiza o status no banco de dados
        $stmt = $pdo->prepare("UPDATE perguntas SET status = :status WHERE id_pergunta = :id");
        $stmt->execute(['status' => $novo_status, 'id' => $id_pergunta]);
    }
    header("Location: gerenciar_perguntas.php"); // Redireciona após a alteração
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Perguntas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bem-vindo ao Painel Administrativo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    <p>Aqui você pode gerenciar suas perguntas.</p>

    <h2>Adicionar Nova Pergunta</h2>
    <form method="POST">
        <input type="text" name="nova_pergunta" placeholder="Digite sua pergunta" required>
        <button type="submit">Adicionar</button>
    </form>

    <h3>Perguntas Existentes</h3>
    <table>
        <thead>
            <tr>
                <th>Pergunta</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perguntas as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['texto']); ?></td>
                    <td><?php echo htmlspecialchars($item['status']); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $item['id_pergunta']; ?>">
                            <input type="text" name="editar_pergunta" placeholder="Editar pergunta" required>
                            <button type="submit">Editar</button>
                        </form>
                        <a href="?remover=<?php echo $item['id_pergunta']; ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover esta pergunta?');">Remover</a>
                        <a href="?toggle=<?php echo $item['id_pergunta']; ?>" class="btn-toggle" onclick="return confirm('Tem certeza que deseja <?php echo $item['status'] === 'ativa' ? 'desativar' : 'ativar'; ?> esta pergunta?');">
                            <?php echo $item['status'] === 'ativa' ? 'Desativar' : 'Ativar'; ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="dashboard.php">Voltar ao Painel</a>  
</body>
</html>
