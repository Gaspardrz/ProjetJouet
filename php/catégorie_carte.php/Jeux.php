<?php
// filepath: c:/MAMP/htdocs/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Jeux.php

// Simulated database of products
$products = [
    [
        'id' => 21,
        'image' => '../../images/jeuxvideos/FC25.jpg',
        'title' => 'FC 25',
        'description' => 'Le plus grand jeu de foot jamais créé, vivez une expérience unique.'
    ],
    [
        'id' => 22,
        'image' => '../../images/jeuxvideos/NBA-2K25.jpg',
        'title' => 'NBA 2K25',
        'description' => 'Vous préférez le basket au foot ? Alors ce jeu est fait pour vous.'
    ],
    [
        'id' => 23,
        'image' => '../../images/jeuxvideos/ladybug.jpg',
        'title' => 'Miraculous Ladybug',
        'description' => 'Protégez Paris avec l\'aide de la plus grande héroïne de la capitale !'
    ],
    [
        'id' => 24,
        'image' => '../../images/jeuxvideos/harry potter.jpg',
        'title' => 'Lego Harry Potter',
        'description' => 'Étudiez dans la plus grande école de sorcellerie, n\'est-ce pas incroyable ?'
    ],
    [
        'id' => 25,
        'image' => '../../images/jeuxvideos/ratchete.jpg',
        'title' => 'Ratchet et Clank',
        'description' => 'Le renard le plus populaire de l\'espace est de retour avec son ami robot !'
    ],
    [
        'id' => 26,
        'image' => '../../images/jeuxvideos/Dragon-Ball.jpg',
        'title' => 'Sparking Zero !!',
        'description' => 'Le retour de la plus grande saga, rejoignez Goku pour de nouvelles aventures !'
    ],
    [
        'id' => 27,
        'image' => '../../images/jeuxvideos/sonic.jpg',
        'title' => 'Sonic Frontiers',
        'description' => 'L\'emblématique hérisson bleu, venez voir comment il court vite !'
    ],
    [
        'id' => 28,
        'image' => '../../images/jeuxvideos/Park-Beyond.jpg',
        'title' => 'Park Beyond',
        'description' => 'Vous êtes le maître de votre parc, faites venir un maximum de clients.'
    ],
    [
        'id' => 29,
        'image' => '../../images/jeuxvideos/LEGO-Star-Wars.jpg',
        'title' => 'Lego: Star Wars - La Saga Skywalker',
        'description' => 'Jouez dans l\'univers des 9 films avec un tout nouveau jeu.'
    ]
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    // Simulate adding the product to the cart
    // In a real application, you would save this to a database or session
    echo "<script>alert('Produit ajouté au panier avec succès !');</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Toy'isen - Jeux Vidéos</title>
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
        <h2>Nos Jeux-Vidéos</h2>
        <div class="produit-container">
            <?php foreach ($products as $product): ?>
                <div class="produit-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                    <div class="info">
                        <h3><?= htmlspecialchars($product['title']) ?></h3>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                    <form method="POST" action="">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
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
