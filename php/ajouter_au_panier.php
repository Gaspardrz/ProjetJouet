<?php
// Afficher toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

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