<?php
// filepath: c:/MAMP/htdocs/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Cartes.php

// Sample data for "Cartes à jouer" products
$products = [
    [
        'id' => 31,
        'image' => '../../images/cartes/pokemon.jpg',
        'title' => 'Cartes Pokémon',
        'description' => 'Collectionnez et jouez avec les cartes Pokémon les plus rares.',
    ],
    [
        'id' => 32,
        'image' => '../../images/cartes/magic.jpg',
        'title' => 'Cartes Magic: The Gathering',
        'description' => 'Découvrez le jeu de cartes stratégique le plus populaire.',
    ],
    [
        'id' => 33,
        'image' => '../../images/cartes/yugioh.jpg',
        'title' => 'Cartes Yu-Gi-Oh!',
        'description' => 'Invoquez vos monstres et devenez le roi des duels.',
    ],
    [
        'id' => 34,
        'image' => '../../images/cartes/uno.jpg',
        'title' => 'Cartes Uno',
        'description' => 'Le jeu de cartes familial incontournable.',
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Cartes à Jouer - Toy'isen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/css_categorie/figurine.css">
    <meta charset="UTF-8">
</head>
<body>
    <header>   
        <nav class="navbar">
            <div class="subnav">
                <div class="boxnav">
                    <div class="navbar-logo">
                        <a href="../../index.html"><img src="../../images/logo.png" alt="Logo Jouet" class="logo"></a>
                    </div>
                    <div class="navbar-title">
                        <h1> Toy'isen </h1>
                    </div>
            
                    <div class="top-bar-right">
                        <a href="../../page/connexion.html">Connexion</a>
                        <a href="../../page/inscription.html">S'inscrire</a>
                    </div>
                </div>

                <div class="boxnav">
                    <a class="liennav" href="../../page/catégorie/catégorie-carte.html">Cartes à jouer</a>
                    <a class="liennav" href="../../page/catégorie/catégorie-mini-voiture.html">Mini Voitures</a>
                    <a class="liennav" href="../../page/catégorie/catégorie-nerf.html">Nerfs</a>
                    <a class="liennav" href="../../page/catégorie/catégorie-figurines.html">Figurines</a>
                    <a class="liennav" href="../../page/catégorie/catégorie-jeuxvideos.html">Jeux Vidéos</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <h2>Nos Cartes à Jouer</h2>
        <div class="produit-container">
            <?php foreach ($products as $product): ?>
                <div class="produit-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                    <div class="info">
                        <h3><?= htmlspecialchars($product['title']) ?></h3>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                    <form action="../../php/panier.php" method="post">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>© 2024 Toy'isen - Tous droits réservés.</p>
    </footer>
</body>
</html>
