<?php
// Informations de connexion à la base de données
$serverName = "filrougematteojulien.database.windows.net";
$connectionOptions = array(
    "Database" => "filrouge",
    "Uid" => "CloudSAdeaa70e5",
    "PWD" => "xewpom-hocmuk-5deWha"
);

// Établir la connexion
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Vérifier si la connexion a réussi
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Insérer les données dans la base de données
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Rediriger vers une page de succès ou effectuer une autre action
    header("Location: registration_success.php");
    exit();
}

// Fermer la connexion à la base de données
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
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