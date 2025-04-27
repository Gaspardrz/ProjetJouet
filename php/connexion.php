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
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    try {
        // Vérifie si l'utilisateur existe
        $stmt = $conn->prepare("SELECT * FROM client WHERE MailCLien = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            // Vérifie si le mot de passe est correct
            if (password_verify($password, $user['MdpClient'])) {
                $_SESSION['user'] = $user;

                // Vérifie si l'utilisateur a déjà un panier
                $stmt_panier = $conn->prepare("SELECT * FROM panier WHERE user_id = :user_id");
                $stmt_panier->bindParam(':user_id', $email);
                $stmt_panier->execute();
                $panier = $stmt_panier->fetch();

                if (!$panier) {
                    // Crée un panier vide pour l'utilisateur
                    $stmt_insert_panier = $conn->prepare("INSERT INTO panier (user_id, produit_id, categorie, quantite) VALUES (:user_id, 0, '', 0)");
                    $stmt_insert_panier->bindParam(':user_id', $email);
                    $stmt_insert_panier->execute();
                }

                // Redirige vers l'espace client
                header('Location: /projet jouer - Copie (2)/ProjetJouet/php/espace-client.php');
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la connexion : " . $e->getMessage();
    }
}
?>