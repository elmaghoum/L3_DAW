<?php
// Database connection
$host = 'localhost';
$dbname = 'projet_daw';
$username = 'root';
$password = 'root';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
