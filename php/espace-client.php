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
include __DIR__ . '/header.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /projet jouer - Copie (2)/ProjetJouet/php/connexion.php");
    exit();
}

// Récupération des données utilisateur depuis la session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client</title>
    <link rel="stylesheet" href="/projet jouer - Copie (2)/ProjetJouet/css/espace-client.css">
    <style>
        /* Pop-up des cookies */
        #cookie-popup {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            display: none; /* Masqué par défaut */
            z-index: 1000;
        }
        #cookie-popup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-left: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        #cookie-popup button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="box">
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p style="color: green;">Informations mises à jour avec succès !</p>
        <?php endif; ?>

        <h1>Bienvenue, <?php echo htmlspecialchars($user['Prénom']) . " " . htmlspecialchars($user['Nom']); ?> !</h1>
        <p class="user-info">Adresse email : <?php echo htmlspecialchars($user['MailCLien']); ?></p>

        <!-- Affichage de la photo de profil -->
        <div class="profile-photo">
            <?php 
            $photo = !empty($user['photoProfil']) ? $user['photoProfil'] : '/projet jouer - Copie (2)/ProjetJouet/images/default-profile.jpg';
            ?>
            <img src="<?php echo htmlspecialchars($photo); ?>" 
                 alt="Photo de profil" 
                 style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">

            <!-- Bouton pour supprimer la photo de profil -->
            <?php if (!empty($user['photoProfil'])): ?>
                <form action="delete_photo.php" method="POST" style="margin-top: 10px;">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['MailCLien']); ?>">
                    <button type="submit" name="delete_photo" style="background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                        Supprimer la photo de profil
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Formulaire pour modifier les informations -->
        <form action="update_user.php" method="POST" enctype="multipart/form-data">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($user['Prénom']); ?>" required>

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['Nom']); ?>" required>

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['MailCLien']); ?>" required>

            <label for="photo">Changer la photo de profil :</label>
            <input type="file" name="photo" id="photo" accept="image/*">

            <button type="submit" name="update">Modifier les informations</button>
        </form>
    </div>
</div>

<!-- Pop-up des cookies -->
<div id="cookie-popup">
    Ce site utilise des cookies pour améliorer votre expérience. 
    <button id="accept-cookies">Accepter</button>
</div>

<script>
    // Vérifie si le cookie de consentement existe
    if (!document.cookie.includes("cookies_accepted=true")) {
        document.getElementById("cookie-popup").style.display = "block";
    }

    // Ajoute un cookie lorsque l'utilisateur accepte
    document.getElementById("accept-cookies").addEventListener("click", function () {
        document.cookie = "cookies_accepted=true; path=/; max-age=" + 60 * 60 * 24 * 30; // 30 jours
        document.getElementById("cookie-popup").style.display = "none";
    });
</script>

</body>
</html>
<?php
include __DIR__ . '/footer.php';
?>