<?php
// Vérification si la connexion à la base de données est déjà établie
if (!isset($pdo)) {
    $host = 'localhost';
    $dbname = 'projet25_infoclient';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

// Récupération des données depuis la table `cartes`
$query = $pdo->query("SELECT id, image, titre AS title, description, prix FROM cartes");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Cartes à Jouer - Toy'isen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/projet jouer - Copie (2)/ProjetJouet/css/css_categorie/figurine.css">
    <meta charset="UTF-8">
</head>
<body>
    <header>   
        <nav class="navbar">
            <div class="subnav">
                <div class="boxnav">
                    <div class="navbar-logo">
                        <a href="/projet jouer - Copie (2)/ProjetJouet/php/index.php"><img src="/projet jouer - Copie (2)/ProjetJouet/images/logo.png" alt="Logo Jouet" class="logo"></a>
                    </div>
                    <div class="navbar-title">
                        <h1> Toy'isen </h1>
                    </div>
            
                    <div class="top-bar-right">
                    <a href="/projet jouer - Copie (2)/ProjetJouet/php/espace-client.php">Profil</a>
                    <a href="/projet jouer - Copie (2)/ProjetJouet/php/logout.php">Déconnexion</a>
                    <a href="/projet jouer - Copie (2)/ProjetJouet/php/panier.php">Panier</a>

                    </div>
                </div>

                <div class="boxnav">
                    <a class="liennav" href="/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Cartes.php">Cartes à jouer</a>
                    <a class="liennav" href="/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Voitures.php">Mini Voitures</a>
                    <a class="liennav" href="/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Nerfs.php">Nerfs</a>
                    <a class="liennav" href="/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Figurines.php">Figurines</a>
                    <a class="liennav" href="/projet jouer - Copie (2)/ProjetJouet/php/catégorie_carte.php/Jeux.php">Jeux Vidéos</a>
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
                        <p><strong>Prix : <?= htmlspecialchars($product['prix']) ?> €</strong></p>
                    </div>
                    <form action="/projet jouer - Copie (2)/ProjetJouet/php/ajouter_au_panier.php" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                        <input type="hidden" name="categorie" value="cartes"> <!-- Ajoutez la catégorie -->
                        <input type="hidden" name="quantite" value="1">
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