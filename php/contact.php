<?php
session_start();

$host = 'localhost';
$dbname = 'infoconnexion';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $errors[] = "Email et mot de passe obligatoires.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM client WHERE MailCLien = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['MdpClient'])) {
            $_SESSION['user'] = $user;
            $_SESSION['prenom'] = $user['Prénom'];
            $_SESSION['nom'] = $user['Nom'];
            $_SESSION['email'] = $user['MailCLien'];

            header("Location: espace-client.php");
            exit();
        } else {
            $errors[] = "Identifiants incorrects.";
        }
    }

    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
