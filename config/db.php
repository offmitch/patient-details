<?php
$host = 'mysql-230c80a0-gurshaandaula-e98a.k.aivencloud.com';
$db   = 'defaultdb';
$user = 'avnadmin';
$pass = '';
$port = 12515;
// $ssl_ca = __DIR__ . '/ca.pem';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

$options = [
    // PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
