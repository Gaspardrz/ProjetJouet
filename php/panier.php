<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: /projet jouer - Copie (2)/ProjetJouet/page/connexion.html');
    exit();
}

// Inclure le fichier header
include __DIR__ . '/header.php';

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=projet25_infoclient;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Affichage du panier
$cart = $_SESSION['panier'] ?? [];
$cartTotal = 0;
$totalQuantity = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="/projet jouer - Copie (2)/ProjetJouet/css/panier.css">
</head>
<body>
    <div class="container">
        <h2>Votre Panier</h2>

        <?php if (empty($cart)): ?>
            <p class="empty-cart">Votre panier est vide.</p>
            <a href="javascript:history.back()" class="btn">Retour</a>
        <?php else: ?>
            <form method="post" action="maj_panier.php">
                <table>
                    <thead>
                        <tr>
                            <th>Nom du produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $index => $item): ?>
                            <?php
                            $id = $item['id'];
                            $categorie = $item['categorie'];
                            $quantite = $item['quantite'];

                            // Récupérer depuis la bonne table
                            $stmt = $pdo->prepare("SELECT * FROM $categorie WHERE id = ?");
                            $stmt->execute([$id]);
                            $product = $stmt->fetch();

                            if (!$product) continue;

                            $productPrice = $product['prix'];
                            $productName = $product['nom'] ?? $product['titre']; // Selon la table
                            $productTotal = $productPrice * $quantite;

                            $cartTotal += $productTotal;
                            $totalQuantity += $quantite;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($productName) ?></td>
                                <td>
                                    <input type="number" name="quantities[<?= $index ?>]" value="<?= $quantite ?>" min="0">
                                </td>
                                <td><?= number_format($productPrice, 2) ?> €</td>
                                <td><?= number_format($productTotal, 2) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total articles :</strong> <?= $totalQuantity ?></td>
                            <td colspan="2"><strong>Total panier :</strong> <?= number_format($cartTotal, 2) ?> €</td>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" name="update_cart" class="btn">Mettre à jour le panier</button>
            </form>

            <form method="post" action="valide-panier.php">
                <button type="submit" class="btn">Valider le panier</button>
            </form>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>