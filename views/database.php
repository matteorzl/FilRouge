<?php
    // Paramètres de connexion à la base de données
    $serverName = "filrougematteojulien.database.windows.net";
    $database = "filrouge";
    $username = "CloudSAdeaa70e5";
    $password = "xewpom-hocmuk-5deWha";

    try {
        // Création d'une nouvelle connexion PDO à la base de données
        $conn = new PDO("sqlsrv:server=$serverName;database=$database", $username, $password);
        
        // Configuration du mode d'erreur de PDO pour afficher les exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Affichage de l'erreur de connexion
        die("Erreur de connexion : " . $e->getMessage());
    }
?>
