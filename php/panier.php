<?php
include __DIR__ . '/header.php';

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=infoconnexion;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fonction pour ajouter un produit au panier
if (isset($_GET['add'])) {
    $productId = (int)$_GET['add']; // ID du produit
    $quantity = 1; // Quantité fixe par défaut

    // Vérifie si le produit est déjà dans le panier, sinon l'ajoute
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    header('Location: panier.php'); // Redirige vers le panier après ajout
    exit();
}

// Fonction pour retirer un produit du panier
if (isset($_GET['remove'])) {
    $productId = (int)$_GET['remove']; // ID du produit à retirer

    unset($_SESSION['cart'][$productId]);

    header('Location: panier.php'); // Redirige vers le panier après suppression
    exit();
}

// Affichage du panier
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cartTotal = 0;

// Afficher le panier avec les produits
?>
<?php include __DIR__ . '/../php/includes/header.php'; ?>
<h2>Votre Panier</h2>

<?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Nom du produit</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($cart as $productId => $quantity): ?>
            <?php
            // Récupérer les informations du produit depuis la BDD
            $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch();
            $productPrice = $product['prix'];
            $productName = $product['nom'];
            $productTotal = $productPrice * $quantity;
            $cartTotal += $productTotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($productName) ?></td>
                <td><?= $quantity ?></td>
                <td><?= number_format($productTotal, 2) ?> €</td>
                <td><a href="panier.php?remove=<?= $productId ?>">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total : <?= number_format($cartTotal, 2) ?> €</h3>
    <a href="payment.php">Procéder au paiement</a>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
