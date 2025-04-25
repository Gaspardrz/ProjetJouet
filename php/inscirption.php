<?php
include __DIR__ . '/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate email
    if (empty($_POST['mail'])) {
        $errors[] = "L'adresse email est obligatoire.";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    }

    // Validate password
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
        }
    }

    // Display errors or success message
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        // Add a "Retour" button
        echo "<a href='inscription.html' style='color: blue; text-decoration: underline;'>Retour</a>";
    } else {
        echo "<p style='color: green;'>Inscription réussie !</p>";
        // Here you can add code to save the data to a database or perform other actions
    }
}
include __DIR__ . '/footer.php';
?>