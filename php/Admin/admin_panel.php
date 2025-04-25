<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Bienvenue, Admin !</h2>";
echo "<p><a href='logout.php'>Se déconnecter</a></p>";

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infoconnexion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les informations des utilisateurs
$sql = "SELECT MailCLien, MdpClient, Nom, `Prénom` FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Liste des utilisateurs :</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Mail</th><th>Nom</th><th>Prénom</th><th>Mot de passe</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["MailCLien"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Nom"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Prénom"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["MdpClient"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

$conn->close();
?>
