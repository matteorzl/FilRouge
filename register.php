<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $params = array($username, $hashedPassword);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('header.html') ?>
    <title>Page d'inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
