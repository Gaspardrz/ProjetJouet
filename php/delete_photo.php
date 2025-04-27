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

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /projet jouer - Copie (2)/ProjetJouet/php/connexion.php");
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'projet25_infoclient';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_photo'])) {
    $email = htmlspecialchars($_POST['email']);

    try {
        // Supprimer la photo de profil dans la base de données
        $stmt = $conn->prepare("UPDATE client SET photoProfil = NULL WHERE MailCLien = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Mettre à jour la session
        $_SESSION['user']['photoProfil'] = null;

        // Rediriger vers l'espace client avec un message de succès
        header("Location: /projet jouer - Copie (2)/ProjetJouet/php/espace-client.php?success=1");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression de la photo : " . $e->getMessage());
    }
}
?>