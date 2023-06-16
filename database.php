<?php
$serverName = "filrougematteojulien.database.windows.net";
$database = "filrouge";
$username = "CloudSAdeaa70e5";
$password = "xewpom-hocmuk-5deWha";

try {
    $conn = new PDO("sqlsrv:server=$serverName;database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
