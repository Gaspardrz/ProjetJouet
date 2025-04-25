<?php

session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Toy'Isen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main-style.css">
    <meta charset="UTF-8">
    <link rel="icon" href="images/logo.png">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="subnav">
                <div class="boxnav">
                    <div class="navbar-logo">
                        <a href="index.php"><img src="images/logo.png" alt="Logo Jouet" class="logo"></a>
                    </div>
                    <div class="navbar-title">
                        <h1> Toy'isen </h1>
                    </div>
            
                    <div class="top-bar-right">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <!-- Si l'utilisateur est connecté, afficher sa photo de profil -->
                            <a href="profil.php">
                                <img src="uploads/<?= $_SESSION['photo_profil']; ?>" alt="Photo de Profil" class="profile-photo" width="40" height="40" style="border-radius: 50%; border: 2px solid #fff;">
                            </a>
                            <a href="profil.php?logout=true"><button>Se déconnecter</button></a>
                        <?php else: ?>
                            <!-- Si l'utilisateur n'est pas connecté, afficher les liens de connexion -->
                            <a href="page/connexion.html">Connexion</a>
                            <a href="page/inscription.html">S'inscrire</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="boxnav">
                    <a class="liennav" href="page/catégorie/catégorie-carte.html">Cartes à jouer</a>
                    <a class="liennav" href="page/catégorie/catégorie-mini-voiture.html">Mini Voitures</a>
                    <a class="liennav" href="page/catégorie/catégorie-nerf.html">Nerfs</a>
                    <a class="liennav" href="page/catégorie/catégorie-figurines.html">Figurines</a>
                    <a class="liennav" href="page/catégorie/catégorie-jeuxvideos.html">Jeux Vidéos</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <h2>Bienvenue sur le site de Toy'isen, le spécialiste des jouets pour enfants.</h2>
        <div class="images">
            <div class="left-image preview-container">
                <a href="page/catégorie/catégorie-carte.html" class="preview-link">
                    <img src="images/cartes.jpg" alt="Carte Yu-Gi-Oh">
                    <div class="preview">
                        <img src="images/preview/preview-carte.png" alt="Preview Yu-Gi-Oh" />
                    </div>
                </a>
                <div class="images-description">
                    Un jeu de cartes à jouer et à collectionner, c’est une aventure stratégique où chaque carte rare enrichit votre collection. Construisez votre deck, affrontez vos amis et vivez l’excitation du jeu et de la compétition !
                </div>
            </div>
            
            <div class="right-image preview-container">
                <div class="images-description">
                    Les minivoitures, c’est la passion de la vitesse en miniature ! Collectionnez, jouez et recréez des courses légendaires avec ces modèles détaillés qui raviront petits et grands.
                </div>
                <a href="page/catégorie/catégorie-mini-voiture.html" class="preview-link">
                    <img src="images/voitures.jpg" alt="Mini voiture">
                    <div class="preview">
                        <img src="images/preview/preview-voitures.png" alt="Preview Mini-Voitures" />
                    </div>
                </a>
            </div>
            
            <div class="left-image preview-container">
                <a href="page/catégorie/catégorie-nerf.html" class="preview-link">
                    <img src="images/nerfs.jpg" alt="Pistolet Nerf">
                    <div class="preview">
                        <img src="images/preview/preview-nerf.png" alt="Preview Nerfs" />
                    </div>
                </a>
                <div class="images-description">
                    Les pistolets Nerf, c’est l’action à toute épreuve ! Visez, tirez et défiez vos amis dans des batailles épiques, tout en collectionnant des blasters puissants et innovants.
                </div>
            </div>
            
            <div class="right-image preview-container">
                <div class="images-description">
                    Les figurines, c’est l’occasion de collectionner vos héros préférés ! Recréez des scènes iconiques ou exposez des personnages détaillés qui apportent de la magie à votre collection.
                </div>
                <a href="page/catégorie/catégorie-figurines.html" class="preview-link">
                    <img src="images/figurines.jpg" alt="Figurine Funko Pop">
                    <div class="preview">
                        <img src="images/preview/preview-figurine.png" alt="Preview Figurines" />
                    </div>
                </a>
            </div>
            
            <div class="left-image preview-container">
                <a href="page/catégorie/catégorie-jeuxvideos.html" class="preview-link">
                    <img src="images/figurine LOL.png" alt="Jeux Vidéos">
                    <div class="preview">
                        <img src="images/preview/preview-jeux.png" alt="Preview Jeux Vidéos" />
                    </div>
                </a>
                <div class="images-description">
                    Les jeux vidéo, c’est l’immersion totale dans des mondes captivants ! Explorez, combattez et vivez des aventures incroyables tout en débloquant des univers riches et variés.
                </div>
            </div>
        </div>        

        <div class="Histoire">
            <h3>Qui sommes nous ?</h3>
        </div>
        <div class="articles">
            <p>Toy'isen est la nouvelle firme de Junia fondé et organisé exclusivement par ses étudiants.<br>
                Elle a pour but principal de vendre des jouets de qualité construits par les artisans ingénieurs de l'école</p><br>
        </div> 
        <h3>Que Pouvons nous attendre des produits Toy'Isen ?</h3>
        <div class="produits">
            <p>La qualité des produits de Toy'isen n'est plus a prouver et a déjà satisfait un grand nombre de clients partout en France</p><br>
            <p>Les produits utilisés pour fabriquer nos jouets sont issus du commerce durable et respectueux de l'environnement !</p>
        </div>
    </div>

    </main>

    <footer>
        <p>© 2024 Toy'isen - Tous droits réservés.</p>
    </footer>
</body>
</html>
