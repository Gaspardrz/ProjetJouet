<?php
include __DIR__ . '/../php/includes/header.php';
include __DIR__ . '/php/includes/footer.php';
session_start();

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
header('Location: ../index.html');
exit();
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