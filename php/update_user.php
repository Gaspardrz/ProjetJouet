<?php
session_start();
include __DIR__ . '/header.php';


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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $photoPath = $_SESSION['user']['photoProfil']; // Par défaut, conserver l'ancienne photo

    // Vérifier si une nouvelle photo a été téléchargée
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Vérifier le poids du fichier (max 2 Mo)
        if ($_FILES['photo']['size'] <= 2 * 1024 * 1024) { 
            // Vérifier le type du fichier
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['photo']['type'], $allowedTypes)) {
                $uploadDir = __DIR__ . '/../uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
                $uploadFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photoPath = '/projet jouer - Copie (2)/ProjetJouet/uploads/' . $filename;
                }
            } else {
                die("Erreur : Type de fichier non autorisé. Veuillez uploader une image JPG, PNG ou GIF.");
            }
        } else {
            die("Erreur : Le fichier est trop lourd (max 2 Mo).");
        }
    }

    // Mettre à jour les informations dans la base de données
    try {
        $stmt = $conn->prepare("UPDATE client SET Prénom = :prenom, Nom = :nom, MailCLien = :email, photoProfil = :photo WHERE MailCLien = :currentEmail");
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':photo', $photoPath);
        $stmt->bindParam(':currentEmail', $_SESSION['user']['MailCLien']);
        $stmt->execute();

        // Mettre à jour la session
        $_SESSION['user']['Prénom'] = $prenom;
        $_SESSION['user']['Nom'] = $nom;
        $_SESSION['user']['MailCLien'] = $email;
        $_SESSION['user']['photoProfil'] = $photoPath;

        // Redirection
        header("Location: /projet jouer - Copie (2)/ProjetJouet/php/espace-client.php?success=1");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour des informations : " . $e->getMessage());
    }
}
?>
