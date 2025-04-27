<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'projet25_infoclient';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Insère les informations dans la table `client`
        $stmt = $conn->prepare("INSERT INTO client (MailCLien, MdpClient, Nom, Prénom) VALUES (:email, :password, :nom, :prenom)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->execute();

        // Crée un panier vide pour l'utilisateur
        $stmt_insert_panier = $conn->prepare("INSERT INTO panier (user_id, produit_id, categorie, quantite) VALUES (:user_id, 0, '', 0)");
        $stmt_insert_panier->bindParam(':user_id', $email);
        $stmt_insert_panier->execute();

        // Connecte automatiquement l'utilisateur après l'inscription
        $_SESSION['user'] = [
            'MailCLien' => $email,
            'Nom' => $nom,
            'Prénom' => $prenom
        ];

        header('Location: /projet jouer - Copie (2)/ProjetJouet/php/espace-client.php');
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>