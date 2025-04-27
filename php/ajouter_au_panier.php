<?php
// Afficher toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Vérifie que les données existent et sont valides
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$categorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_SPECIAL_CHARS);
$quantite = filter_input(INPUT_POST, 'quantite', FILTER_VALIDATE_INT);

if ($id && $categorie && $quantite && $quantite > 0) {
    // Initialise le panier s'il n'existe pas encore
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Cherche si le produit existe déjà dans le panier
    $found = false;
    foreach ($_SESSION['panier'] as &$item) {
        if ($item['id'] == $id && $item['categorie'] == $categorie) {
            $item['quantite'] += $quantite;
            $found = true;
            break;
        }
    }
    unset($item); // Toujours unset la référence après un foreach modifiant

    if (!$found) {
        $_SESSION['panier'][] = [
            'id' => $id,
            'quantite' => $quantite,
            'categorie' => $categorie
        ];
    }

    // Redirige vers le panier
    header('Location: panier.php');
    exit();
} else {
    // Affiche un message d'erreur si les données sont invalides
    echo "Erreur : Données invalides ou manquantes.";
    exit();
}