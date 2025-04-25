<?php
session_start();

// Vérifie si le panier n'est pas vide
if (empty($_SESSION['cart'])) {
    header('Location: panier.php');
    exit();
}

// Traitement du paiement (ici, simplement vider le panier)
$_SESSION['cart'] = []; // Réinitialise le panier

// Redirige vers la page de confirmation de paiement
header('Location: payement-effectue.php');
exit();
