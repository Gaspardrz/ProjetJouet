<?php 
include __DIR__ . '/header.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 30px;
        }

        .box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #444;
        }

        p {
            font-size: 16px;
            color: #666;
        }

        .user-info {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .buttons a {
            padding: 10px 20px;
            background-color: #d46a28;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: #aa4f1e;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="box">
            <h1>Bienvenue, <?php echo htmlspecialchars($user['Prénom']) . " " . htmlspecialchars($user['Nom']); ?> !</h1>
            <p class="user-info">Adresse email : <?php echo htmlspecialchars($user['MailCLien']); ?></p>

            <div class="buttons">
                <a href="../page/Shopping.php">Retourner sur le site</a>
                <a href="../logout.php">Se déconnecter</a>
            </div>
        </div>
    </div>

</body>
</html>
<?php
include __DIR__ . '/footer.php';
?>