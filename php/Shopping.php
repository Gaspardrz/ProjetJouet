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

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Si l'utilisateur est connecté, récupérez ses informations
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Par exemple, si vous stockez le nom d'utilisateur

// Redirigez vers la page d'accueil tout en maintenant la session active
header('Location: /ProjetJouet/index.html');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Shopping</title>
</head>
<body>
    <h1>Bienvenue sur la page Shopping</h1>
    <p>Explorez nos produits !</p>
</body>
</html>
<?php
include __DIR__ . '/footer.php';