<?php
header('Content-Type: application/json');
require 'db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM products");
    echo json_encode($stmt->fetchAll());
    
} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = sanitize($data['name']);
    $description = sanitize($data['description']);
    $price = floatval($data['price']);
    $image_url = sanitize($data['image_url']);
    
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    
    if ($stmt->execute([$name, $description, $price, $image_url])) {
        echo json_encode(['success' => true, 'message' => 'Product added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product']);
    }
    
} elseif ($method === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id']);
    
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        echo json_encode(['success' => true, 'message' => 'Product deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
    }
}
?>