<?php
include 'db.php';

// Teste inserção direta
$sugestao = "Teste de inserção"; // Teste com um valor fixo

try {
    $stmt = $pdo->prepare("INSERT INTO avaliacoes (feedback_textual) VALUES (:feedback_textual)");
    $stmt->bindParam(':feedback_textual', $sugestao);
    $stmt->execute();
    echo "Sugestão enviada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao enviar sugestão: " . $e->getMessage();
}
?>
