<?php
$host = 'localhost';
$db = 'hospital';
$user = 'beto';
$pass = '1217';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo 'Conexão falhou: ' . $e->getMessage();
}
?>
