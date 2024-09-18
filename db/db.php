<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=products_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Store the PDO instance in a global variable
$GLOBALS['pdo'] = $pdo;