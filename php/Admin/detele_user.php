<?php
session_start();

// Vérifie si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    header('Location: AdminLog.php');
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "projet25_infoclient");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si l'email est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);

    // Met à jour la colonne `banni` pour marquer l'utilisateur comme banni
    $sql = "UPDATE client SET banni = 1 WHERE MailCLien = '$email'";

    if ($conn->query($sql) === TRUE) {
        // Redirige vers le panel admin avec un message de succès
        $_SESSION['message'] = "L'utilisateur a été banni avec succès.";
        header('Location: admin_panel.php');
        exit();
    } else {
        // Redirige avec un message d'erreur
        $_SESSION['error'] = "Erreur lors de la mise à jour de l'utilisateur : " . $conn->error;
        header('Location: admin_panel.php');
        exit();
    }
} else {
    // Redirige si aucune donnée n'est envoyée
    header('Location: admin_panel.php');
    exit();
}
?>