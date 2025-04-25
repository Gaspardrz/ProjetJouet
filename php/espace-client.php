<?php
include __DIR__ . '/../php/includes/header.php';
include __DIR__ . '/php/includes/footer.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit();
}

// Récupération des données utilisateur depuis la session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            color: #333;
            text-align: center;
            padding: 40px;
        }

        .box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1 {
            color: #444;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #d46a28;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #aa4f1e;
        }
    </style>
</head>
<body>

    <div class="box">
        <h1>Bienvenue, <?php echo htmlspecialchars($user['Prénom']) . " " . htmlspecialchars($user['Nom']); ?> !</h1>
        <p>Adresse email : <?php echo htmlspecialchars($user['MailCLien']); ?></p>
        <a class="shopping" href="../page/Shopping.php">Retourner sur le site</a>
        <a class="logout" href="../logout.php">Se déconnecter</a>
    </div>

</body>
</html>
