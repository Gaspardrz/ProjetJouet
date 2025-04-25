<?php 
include __DIR__ . '/../php/includes/header.php';
include __DIR__ . '/php/includes/footer.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuration de la connexion à la base de données
    $host = 'localhost';
    $dbname = 'infoconnexion';
    $username = 'root';  // Utilisateur de la base de données
    $password = 'root';  // Mot de passe de la base de données (par défaut sur MAMP c'est 'root')

    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Définit le mode d'erreur pour afficher les erreurs
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['mail']);
    $password = $_POST['password'];

    // Vérification de l'existence de l'email dans la table `client` avant de procéder
    $stmt = $conn->prepare("SELECT * FROM client WHERE MailCLien = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé pour un compte existant.";
    } else {
        // Vérification de l'existence de l'email dans la table `créationcompte`
        $stmt = $conn->prepare("SELECT * FROM créationcompte WHERE Mail = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Transfert des données de `créationcompte` à `client`
            try {
                // Préparer l'insertion dans la table `client`
                $transferStmt = $conn->prepare("
                    INSERT INTO client (MailCLien, MdpClient, Nom, Prénom)
                    SELECT Mail, MDP, Nom, Prénom FROM créationcompte WHERE Mail = :email
                ");
                $transferStmt->bindParam(':email', $email);
                $transferStmt->execute();

                // Suppression des données de `créationcompte` après transfert
                $deleteStmt = $conn->prepare("DELETE FROM créationcompte WHERE Mail = :email");
                $deleteStmt->bindParam(':email', $email);
                $deleteStmt->execute();

                // Redirection vers la page de connexion
                header("Location: ../page/connexion.html");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors du transfert ou de l'inscription : " . $e->getMessage();
            }
        } else {
            // Si l'email n'existe pas dans `créationcompte`, on l'insère directement
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion des données dans la table `créationcompte`
            try {
                $stmt = $conn->prepare("INSERT INTO créationcompte (Mail, MDP, Nom, Prénom) VALUES (:email, :password, :nom, :prenom)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':nom', $name);
                $stmt->bindParam(':prenom', $prenom);

                $stmt->execute();

                // Redirection vers la page de connexion
                header("Location: ../page/connexion.html");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de l'inscription : " . $e->getMessage();
            }
        }
    }
}
?>