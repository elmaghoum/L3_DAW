<?php
function checkFileHash($target_dir, $uploaded_file_tmp_name) {
    $uploaded_file_hash = hash_file('sha256', $uploaded_file_tmp_name);

    $files = glob($target_dir . '*.*');
    foreach ($files as $file) {
        $file_hash = hash_file('sha256', $file);
        if ($uploaded_file_hash === $file_hash) {
            return $file;
        }
    }

    return false;
}
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

