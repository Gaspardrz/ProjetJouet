<?php
// filepath: c:/Users/chpri/Documents/code/projet jouer/ProjetJouet/php/panier.php
session_start();
require_once 'db_connection.php'; // Fichier pour la connexion à la base de données

if (!isset($conn) || $conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Veuillez vous connecter pour accéder au panier.");
}

$user_id = $_SESSION['user_id'];

// Ajout d'un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default quantity to 1 if not provided
    $stmt = $conn->prepare("INSERT INTO panier (user_id, product_id, quantity) VALUES (?, ?, ?) 
                            ON DUPLICATE KEY UPDATE quantity = quantity + ?");
    if ($stmt) {
        $stmt->bind_param("iiii", $user_id, $product_id, $quantity, $quantity);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['status' => 'success']);
    } else {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }
    exit;
}

// Suppression d'un produit du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
    } else {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    $stmt = $conn->prepare("DELETE FROM panier WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['status' => 'success']);
    $stmt = $conn->prepare("DELETE FROM panier WHERE user_id = ? AND product_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $user_id, $product_id);
    } else {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }
                            JOIN produits pr ON p.product_id = pr.id 
                            WHERE p.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $product_id = intval($_POST['product_id']);
    $stmt = $conn->prepare("DELETE FROM panier WHERE user_id = ? AND product_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['status' => 'success']);
    } else {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }
    exit;
}
