<?php
session_start();

// Vérifie si le panier existe
if (!isset($_SESSION['panier'])) {
    header('Location: panier.php');
    exit();
}

// Vérifie si des quantités ont été envoyées
if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $index => $quantity) {
        $quantity = (int) $quantity; // Convertit la quantité en entier

        // Si la quantité est 0, supprime l'article du panier
        if ($quantity === 0) {
            unset($_SESSION['panier'][$index]);
        } else {
            // Sinon, met à jour la quantité
            $_SESSION['panier'][$index]['quantite'] = $quantity;
        }
    }

    // Réindexe le tableau du panier pour éviter les trous dans les indices
    $_SESSION['panier'] = array_values($_SESSION['panier']);
}

// Redirige vers la page du panier
header('Location: panier.php');
exit();