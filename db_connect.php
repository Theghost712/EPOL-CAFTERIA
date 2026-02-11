<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'epol-cafteria');
define('DB_USER', 'root');
define('DB_PASS', '');

// Basic sanitization function (MOVE THIS BEFORE PDO CONNECTION)
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>