<?php 
session_start();
require 'db.php'; // Conexão com o banco de dados

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Link para os ícones -->
</head>
<body>
    <h1>Bem-vindo ao Painel Administrativo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    
    <div class="button-container">
        <button id="gerenciarPerguntas" onclick="location.href='gerenciar_perguntas.php'">
            <i class="fas fa-question-circle"></i> Gerenciar Perguntas
        </button>
        <button id="gerenciarTablets" onclick="location.href='gerenciar_tablets.php'">
            <i class="fas fa-tablet-alt"></i> Gerenciar Dispositivos
        </button>
        <button id="gerenciarSetores" onclick="location.href='gerenciar_setores.php'">
            <i class="fas fa-building"></i> Gerenciar Setores
        </button>
        <button id="gerenciarAdmins" onclick="location.href='gerenciar_admins.php'">
            <i class="fas fa-user-shield"></i> Gerenciar Administradores
        </button>
    </div>
    
    <footer>
        <a href="logout.php">Sair</a>
        <br>
        <p>Obrigado por usar o sistema!</p>
    </footer>
</body>
</html>
