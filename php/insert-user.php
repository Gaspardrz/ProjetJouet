<?php
$host = 'localhost';
$dbname = 'infoconnexion';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Données utilisateur
    $email = 'exemplemail@gmail.com';
    $plainPassword = 'motdepasse123';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    $nom = 'Dupont';
    $prenom = 'Jean';

    // Insertion
    $stmt = $conn->prepare("INSERT INTO client (MailCLien, MdpClient, Nom, Prénom) VALUES (:email, :mdp, :nom, :prenom)");
    $stmt->execute([
        ':email' => $email,
        ':mdp' => $hashedPassword,
        ':nom' => $nom,
        ':prenom' => $prenom
    ]);

    echo "✅ Utilisateur inséré avec succès";
    echo "<br>Hash inséré : " . $hashedPassword;

} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
