<?php
session_start();

// Vérifie si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    header('Location: AdminLog.php');
    exit();
}

$conn = new mysqli("localhost", "root", "root", "projet25_infoclient");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupère tous les comptes utilisateurs
$sql_users = "SELECT * FROM client";
$result_users = $conn->query($sql_users);

// Récupère tous les paniers (multi-catégories)
$sql_paniers = "
    SELECT p.*, c.Nom, c.Prénom, pr.titre AS produit_nom, pr.prix, p.categorie
    FROM panier p
    JOIN client c ON p.user_id = c.MailCLien
    JOIN cartes pr ON p.produit_id = pr.id
    WHERE p.categorie = 'cartes'
    UNION ALL
    SELECT p.*, c.Nom, c.Prénom, pr.nom AS produit_nom, pr.prix, p.categorie
    FROM panier p
    JOIN client c ON p.user_id = c.MailCLien
    JOIN figurines pr ON p.produit_id = pr.id
    WHERE p.categorie = 'figurines'
    UNION ALL
    SELECT p.*, c.Nom, c.Prénom, pr.nom AS produit_nom, pr.prix, p.categorie
    FROM panier p
    JOIN client c ON p.user_id = c.MailCLien
    JOIN jeuxvideos pr ON p.produit_id = pr.id
    WHERE p.categorie = 'jeuxvideos';
";
$result_paniers = $conn->query($sql_paniers);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="/projet jouer - Copie (2)/ProjetJouet/css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Panel Admin</h1>

        <!-- Affichage des messages de succès ou d'erreur -->
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?= htmlspecialchars($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <h2>Liste des comptes utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $result_users->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['Nom']) ?></td>
                        <td><?= htmlspecialchars($user['Prénom']) ?></td>
                        <td><?= htmlspecialchars($user['MailCLien']) ?></td>
                        <td>
                            <form method="post" action="detele_user.php" style="display:inline;">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['MailCLien']) ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir bannir cet utilisateur ?');">Bannir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

</body>
</html>