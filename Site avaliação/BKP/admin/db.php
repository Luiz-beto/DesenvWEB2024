<?php
// db.php: Arquivo de conexão com o banco de dados
$host = 'localhost';
$dbname = 'hostipal';
$user = 'beto';
$password = '1217';

// Conectando ao banco de dados PostgreSQL
$conexao = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>
