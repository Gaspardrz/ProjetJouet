<?php
session_start();
include __DIR__ . '/../php/includes/header.php';

$pdo = new PDO('mysql:host=localhost;dbname=infoconnexion;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Mettre à jour les quantités
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $productId => $quantity) {
        $quantity = max(0, (int)$quantity);
        if ($quantity === 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
    header('Location: panier.php');
    exit();
}

// Affichage du panier
$cart = $_SESSION['cart'] ?? [];
$cartTotal = 0;
?>

<h2>Votre Panier</h2>

<?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
    <a href="javascript:history.back()">Retour</a>
<?php else: ?>
    <form method="post" action="panier.php">
        <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $productId => $quantity): ?>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
                    $stmt->execute([$productId]);
                    $product = $stmt->fetch();
                    if (!$product) continue; // Si produit introuvable

                    $productPrice = $product['prix'];
                    $productName = $product['nom'];
                    $productTotal = $productPrice * $quantity;
                    $cartTotal += $productTotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($productName) ?></td>
                        <td><input type="number" name="quantities[<?= $productId ?>]" value="<?= $quantity ?>" min="0"></td>
                        <td><?= number_format($productPrice, 2) ?> €</td>
                        <td><?= number_format($productTotal, 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total général : <?= number_format($cartTotal, 2) ?> €</h3>

        <button type="submit" name="update_cart">Mettre à jour le panier</button>
    </form>

    <form method="post" action="payement.php">
        <button type="submit">Valider le panier</button>
    </form>
    <a href="javascript:history.back()">Retour</a>
<?php endif; ?>

<?php include __DIR__ . '/../php/includes/footer.php'; ?>
