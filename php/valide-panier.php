<?php
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
        <h2 style="color: black;">Paiement effectué avec succès !</h2>
        <div class="Merci">
        <p>Merci pour votre achat.</p>
        </div>
        <a href="/projet jouer - Copie (2)/ProjetJouet/php/index.php" class="btn">Retour à l'accueil</a>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>