<?php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toy'Isen</title>
    <link rel="stylesheet" href="../css/main-style.css">
    <link rel="icon" href="../images/logo.png">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="subnav">
            <div class="boxnav">
                <div class="navbar-logo">
                    <a href="../php/index.php"><img src="../images/logo.png" alt="Logo Jouet" class="logo"></a>
                </div>
                <div class="navbar-title">
                    <h1>Toy'Isen</h1>
                </div>
                <div class="top-bar-right">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="../php/espace-client.php">Profil</a>
                        <a href="../logout.php">Déconnexion</a>
                    <?php else: ?>
                        <a href="../php/connexion.php">Connexion</a>
                        <a href="../php/inscription.php">S'inscrire</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="boxnav">
                <a class="liennav" href="../php/catégorie_carte.php/Cartes.php">Cartes à jouer</a>
                <a class="liennav" href="../php/catégorie_carte.php/Voitures.php">Mini Voitures</a>
                <a class="liennav" href="../php/catégorie_carte.php/Nerfs.php">Nerfs</a>
                <a class="liennav" href="../php/catégorie_carte.php/Figurines.php">Figurines</a>
                <a class="liennav" href="../php/catégorie_carte.php/Jeux.php">Jeux Vidéos</a>
            </div>
        </div>
    </nav>
</header>

<?php
