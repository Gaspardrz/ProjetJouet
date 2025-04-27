<?php
include __DIR__ . '/header.php';
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: /projet jouer - Copie (2)/ProjetJouet/page/connexion.html');
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "projet25_infoclient");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si l'utilisateur est banni
$email = $_SESSION['user']['MailCLien'];
$sql = "SELECT banni FROM client WHERE MailCLien = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['banni'] == 1) {
        // Déconnecte l'utilisateur et affiche un message
        session_destroy();
        echo "<p style='color: red;'>Vous avez été banni du site.</p>";
        echo "<a href='/projet jouer - Copie (2)/ProjetJouet/page/connexion.html' style='color: blue; text-decoration: underline;'>Retour à la page de connexion</a>";
        exit();
    }
}
$pdo = new PDO('mysql:host=localhost;dbname=infoconnexion;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Récupère les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM client WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Gestion des messages
$success = '';
$error = '';

// Modifier les informations si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    // Gestion de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photoName = uniqid() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/' . $photoName);
    } else {
        $photoName = $user['photoProfil']; // Si aucune nouvelle photo
    }

    // Met à jour les informations de l'utilisateur
    try {
        $stmt = $pdo->prepare("UPDATE client SET Prénom = ?, Nom = ?, MailCLien = ?, photoProfil = ? WHERE id = ?");
        $stmt->execute([$prenom, $nom, $email, $photoName, $_SESSION['user_id']]);

        $_SESSION['prenom'] = $prenom; // Met à jour la session
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;

        $success = "Profil mis à jour avec succès.";
        header('Refresh: 2; URL=profil.php'); // Recharge après 2 secondes
    } catch (PDOException $e) {
        $error = "Erreur lors de la mise à jour du profil : " . $e->getMessage();
    }
}

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: connexion.php');
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<h2>Modifier vos informations</h2>

<?php if ($success): ?>
    <p style="color: green;"><?= $success ?></p>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label for="photo">Photo de profil:</label><br>
    <input type="file" name="photo"><br>
    <?php if ($user['photoProfil']): ?>
        <img src="../uploads/<?= htmlspecialchars($user['photoProfil']) ?>" width="100"><br>
    <?php endif; ?>
    <br>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($user['Prénom']) ?>" required><br>
    
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($user['Nom']) ?>" required><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['MailCLien']) ?>" required><br>

    <button type="submit">Sauvegarder</button>
</form>

<a href="profil.php?logout=true"><button>Se déconnecter</button></a>

<?php include __DIR__ . '/footer.php'; ?>
