<?php 

session_start(); // Démarrer la session

// Configuration de la connexion à la base de données
$host = 'localhost';
$dbname = 'projet25_infoclient';
$username = 'root'; // Nom d'utilisateur de la base de données
$password = 'root'; // Mot de passe de la base de données (par défaut sur MAMP, c'est souvent 'root')

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
    if (empty($_POST['email'])) {
        $errors[] = "L'adresse email est obligatoire.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    } else {
        $email = htmlspecialchars($_POST['email']);
    }

    // Validation du mot de passe
    if (empty($_POST['password'])) {
        $errors[] = "Le mot de passe est obligatoire.";
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        try {
            // Requête pour récupérer l'utilisateur correspondant à l'email
            $stmt = $conn->prepare("SELECT * FROM client WHERE MailCLien = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // Vérification du mot de passe
                if (password_verify($password, $user['MdpClient'])) {
                    // Connexion réussie : stockage des informations utilisateur dans la session
                    $_SESSION['user'] = $user; // Stocke toutes les informations de l'utilisateur

                    // Enregistrer les informations principales séparément si nécessaire
                    $_SESSION['prenom'] = $user['Prénom'];
                    $_SESSION['nom'] = $user['Nom'];
                    $_SESSION['email'] = $user['MailCLien'];

                    // Redirection vers l'espace client
                    header("Location: /projet jouer - Copie (2)/ProjetJouet/php/espace-client.php");
                    exit();
                } else {
                    $errors[] = "Mot de passe incorrect.";
                }
            } else {
                $errors[] = "Aucun utilisateur trouvé avec cet email.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la connexion : " . $e->getMessage();
        }
    }

    // Si des erreurs existent, les afficher et rediriger vers connexion.html
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors; // Stocker les erreurs dans la session
        header("Location: /projet jouer - Copie (2)/ProjetJouet/page/connexion.html"); // Redirection vers connexion.html avec un chemin absolu
        exit();
    }
}
?>