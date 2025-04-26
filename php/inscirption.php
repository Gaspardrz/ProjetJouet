<?php
include __DIR__ . '/header.php';

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

    // Validation de l'email
    if (empty($_POST['mail'])) {
        $errors[] = "L'adresse email est obligatoire.";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    } else {
        $email = htmlspecialchars($_POST['mail']);
    }

    // Validation du mot de passe
    if (empty($_POST['password'])) {
        $errors[] = "Le mot de passe est obligatoire.";
    } else {
        $password = $_POST['password'];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        } else {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }
    }

    // Validation du prénom
    if (empty($_POST['prenom'])) {
        $errors[] = "Le prénom est obligatoire.";
    } else {
        $prenom = htmlspecialchars($_POST['prenom']);
    }

    // Validation du nom
    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire.";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<a href='inscription.html' style='color: blue; text-decoration: underline;'>Retour</a>";
    } else {
        try {
            // Insertion dans la table `client`
            $stmt = $conn->prepare("INSERT INTO client (MailCLien, MdpClient, Nom, Prénom) VALUES (:email, :password, :nom, :prenom)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->execute();

            echo "<p style='color: green;'>Inscription réussie !</p>";
            echo "<a href='/projet jouer - Copie (2)/ProjetJouet/php/connexion.php' style='color: blue; text-decoration: underline;'>Se connecter</a>";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
        }
    }
}

include __DIR__ . '/footer.php';
?>