<?php
require_once __DIR__ . '/../config.php';

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    exit('Database connection failed: ' . $error->getMessage());
}
