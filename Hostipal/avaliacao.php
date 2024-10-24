<?php
require 'db.php'; // Inclui a conexão com o banco de dados

function getPerguntaAtiva() {
    global $pdo;
    $stmt = $pdo->query("SELECT texto FROM perguntas WHERE status = 'ativa' LIMIT 1");
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);
    return $pergunta ? $pergunta['texto'] : 'Avalie nosso Atendimento';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nota = isset($_POST['nota']) ? (int)$_POST['nota'] : null;

    if ($nota !== null) {
        // Preparar a consulta para inserir a nota
        $stmt = $pdo->prepare("INSERT INTO avaliacoes (resposta) VALUES (:resposta)");
        $stmt->bindParam(':resposta', $nota);

        if ($stmt->execute()) {
            header("Location: sugestao.php?nota=" . urlencode($nota));
            exit();
        } else {
            echo "Erro ao salvar a avaliação.";
        }
    } else {
        echo "Nota inválida.";
    }
} else {
    $perguntaTitulo = getPerguntaAtiva();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Atendimento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($perguntaTitulo); ?></h1>
    <form method="POST" action="">
        <div class="container" id="containerAvaliacao">
            <?php for ($i = 0; $i <= 10; $i++): ?>
                <div class="box" data-valor="<?php echo $i; ?>" onclick="selecionarNota(<?php echo $i; ?>)"><?php echo $i; ?></div>
            <?php endfor; ?>
        </div>

        <input type="hidden" name="nota" id="nota">
        <div id="avaliacaoSelecionada" style="margin-top: 20px; font-size: 1.5rem;"></div>
        <button type="submit" id="prosseguir" style="display: none;">Prosseguir</button>
    </form>

    <footer>
        <p>Sua avaliação é anônima e nenhuma informação pessoal é solicitada.</p>
    </footer>

    <script>
        function selecionarNota(valor) {
            document.getElementById('nota').value = valor; 
            document.getElementById('avaliacaoSelecionada').innerText = + valor;
            document.getElementById('prosseguir').style.display = 'block'; 
        }
    </script>
</body>
</html>
