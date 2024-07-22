<?php
$host = 'localhost';
$dbname = 'erp_system'; // Adjust to your database name
$username = 'root'; // Adjust to your database username
$password = ''; // Adjust to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
