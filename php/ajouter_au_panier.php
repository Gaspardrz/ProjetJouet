<?php
// Afficher toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérifie que les données existent
if (isset($_POST['id'], $_POST['categorie'], $_POST['quantite'])) {
    $id = (int) $_POST['id'];
    $categorie = htmlspecialchars($_POST['categorie']);
    $quantite = max(1, (int) $_POST['quantite']); // Assurez-vous que la quantité est au moins 1

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
    echo "Erreur : Données manquantes.";
}