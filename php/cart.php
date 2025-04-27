<?php
include __DIR__ . '/header.php';
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: /projet jouer - Copie (2)/ProjetJouet/page/connexion.html');
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "projet25_infoclient");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si l'utilisateur est banni
$email = $_SESSION['user']['MailCLien'];
$sql = "SELECT banni FROM client WHERE MailCLien = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['banni'] == 1) {
        // Déconnecte l'utilisateur et affiche un message
        session_destroy();
        echo "<p style='color: red;'>Vous avez été banni du site.</p>";
        echo "<a href='/projet jouer - Copie (2)/ProjetJouet/page/connexion.html' style='color: blue; text-decoration: underline;'>Retour à la page de connexion</a>";
        exit();
    }
}
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

switch($data['action'] ?? '') {
  case 'add':
    $id = (int)$data['product_id'];
    $qty = (int)($data['quantity'] ?? 1);
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
    echo json_encode(['status'=>'success']);
    break;
  case 'remove':
    $id = (int)$data['product_id'];
    unset($_SESSION['cart'][$id]);
    echo json_encode(['status'=>'success']);
    break;
  default:
    echo json_encode(['status'=>'error','message'=>'Action inconnue']);
    include __DIR__ . '/footer.php';
}
