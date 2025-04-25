<?php
include __DIR__ . '/php/includes/footer.php';
// /php/includes/header.php
session_start();

// Connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=infoconnexion;charset=utf8','root','root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Nombre d'articles dans le panier
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Si connecté, récupère l’URL de la photo depuis la session
$userPhoto = $_SESSION['photo_profil'] ?? '';
?>
<nav class="navbar">
  <div class="boxnav">
    <a href="/index.php"><img src="/images/logo.png" class="logo"></a>
    <h1>Toy'isen</h1>
    <div class="top-bar-right">
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/php/profil.php">
          <img src="/uploads/<?= htmlspecialchars($userPhoto) ?>"
               class="profile-photo" width="40" height="40"
               style="border-radius:50%;border:2px solid #fff;">
        </a>
        <a href="/php/logout.php">Déconnexion</a>
        <a href="/php/panier.php">Panier(<?= $cartCount ?>)</a>
      <?php else: ?>
        <a href="/page/connexion.html">Connexion</a>
        <a href="/page/inscription.php">S'inscrire</a>
        <a href="/php/panier.php">Panier(<?= $cartCount ?>)</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="boxnav">
    <a href="/page/catégorie/catégorie-carte.php">Cartes à jouer</a>
    <a href="/page/catégorie/catégorie-mini-voiture.php">Mini Voitures</a>
    <a href="/page/catégorie/catégorie-nerf.php">Nerfs</a>
    <a href="/page/catégorie/catégorie-figurines.php">Figurines</a>
    <a href="/page/catégorie/catégorie-jeuxvideos.php">Jeux Vidéos</a>
  </div>
</nav>
