<?php
$serverName = "filrougematteojulien.database.windows.net";
$connectionOptions = array(
    "Database" => "filrouge",
    "Uid" => "CloudSAdeaa70e5",
    "PWD" => "xewpom-hocmuk-5deWha"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $params = array($username, $hashedPassword);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    header("Location: registration_success.php");
    exit();
}

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
