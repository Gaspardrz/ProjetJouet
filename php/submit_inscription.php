<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'projet25_infoclient';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validation des champs
    if (empty($_POST['mail'])) {
        $errors[] = "L'adresse email est obligatoire.";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    } else {
        $email = htmlspecialchars($_POST['mail']);
    }

    if (empty($_POST['password'])) {
        $errors[] = "Le mot de passe est obligatoire.";
    } else {
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    if (empty($_POST['prenom'])) {
        $errors[] = "Le prénom est obligatoire.";
    } else {
        $prenom = htmlspecialchars($_POST['prenom']);
    }

    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire.";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
    }

    // Affichage des erreurs ou insertion dans la base de données
    if (!empty($errors)) {
        echo "<div style='text-align: center;'>";
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<a href='/projet jouer - Copie (2)/ProjetJouet/page/inscription.html' class='liennav'>Retour</a>";
        echo "</div>";
    } else {
        try {
            // Insertion dans la table `client`
            $stmt = $conn->prepare("INSERT INTO client (MailCLien, MdpClient, Nom, `Prénom`) VALUES (:email, :password, :nom, :prenom)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->execute();

            echo "<div style='text-align: center; margin-top: 50px;'>";
            echo "<p style='color: green; font-size: 1.5rem;'>Inscription réussie !</p>";
            echo "<a href='/projet jouer - Copie (2)/ProjetJouet/page/connexion.html' class='liennav' style='padding: 10px 20px; background-color: grey; border-radius: 5px;'>Se connecter</a>";
            echo "</div>";
        } catch (PDOException $e) {
            echo "<div style='text-align: center;'>";
            echo "<p style='color: red;'>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
            echo "<a href='/projet jouer - Copie (2)/ProjetJouet/page/inscription.html' class='liennav'>Retour</a>";
            echo "</div>";
        }
    }
}
?>