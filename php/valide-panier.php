<?php
session_start();

// Vider le panier après le paiement
unset($_SESSION['panier']);

include __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement effectué</title>
    <link rel="stylesheet" href="/projet jouer - Copie (2)/ProjetJouet/css/panier.css">
</head>
<body>
    <div class="container">
        <h2>Paiement effectué avec succès !</h2>
        <div class="Merci">
        <p>Merci pour votre achat.</p>
        </div>
        <a href="/projet jouer - Copie (2)/ProjetJouet/php/index.php" class="btn">Retour à l'accueil</a>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>