<?php
session_start();
$conn = new mysqli("localhost", "root", "", "infoconnexion");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION["admin"] = $user;
        header("Location: admin_panel.php");
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="submit" value="Connexion">
</form>
