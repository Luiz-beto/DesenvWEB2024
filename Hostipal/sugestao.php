<?php
require 'db.php'; // Inclui a conexão com o banco de dados

$nota = isset($_GET['nota']) ? (int)$_GET['nota'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sugestao = isset($_POST['sugestao']) ? trim($_POST['sugestao']) : '';

    // Verifica se a nota é válida
    if ($nota === null) {
        echo "Nota inválida.";
    } else {
        // Preparar a consulta para inserir a sugestão
        $stmt = $pdo->prepare("INSERT INTO avaliacoes (resposta, feedback_textual) VALUES (:resposta, :feedback_textual)");
        $stmt->bindParam(':resposta', $nota);
        $stmt->bindParam(':feedback_textual', $sugestao);

        if ($stmt->execute()) {
            // Excluir a nota que foi salva anteriormente
            $stmt = $pdo->prepare("DELETE FROM avaliacoes WHERE resposta = :resposta AND feedback_textual IS NULL");
            $stmt->bindParam(':resposta', $nota);
            $stmt->execute();

            header("Location: avaliacao_enviada.html"); // Redireciona para a página de sucesso
            exit();
        } else {
            echo "Erro ao salvar a sugestão.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Deixe sua Sugestão</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Deixe sua Sugestão</h1>
    <form method="POST">
        <textarea name="sugestao" rows="4" cols="30" placeholder="Escreva sua sugestão aqui..."></textarea>
        <input type="hidden" name="nota" value="<?php echo htmlspecialchars($nota); ?>">
        <button type="submit">Enviar</button>
    </form>

    <footer>
        <p>Sua avaliação é anônima e nenhuma informação pessoal é solicitada.</p>
    </footer>
</body>
</html>
