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