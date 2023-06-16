<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    $params = array($username);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            // Authentification réussie
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Nom d'utilisateur ou mot de passe incorrect
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('header.html') ?>
    <title>Page de connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>