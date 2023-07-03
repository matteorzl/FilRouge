<?php
    session_start();
    require_once "../database.php";

    $lastname = "Doe";
    $firstname = "John";
    $mail = "john.doe@azerty.com";
    $pwd = "1234";
    $role = 1;

    // Hachage du mot de passe
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

    // Requête SQL pour insérer un nouvel utilisateur
    $sql = "INSERT INTO users (lastname, firstname, mail, pwd, role)
            VALUES (:lastname, :firstname, :mail, :pwd, :role)";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    // Liaison des valeurs aux paramètres de la requête
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":mail", $mail);
    $stmt->bindParam(":pwd", $hashedpwd);
    $stmt->bindParam(":role", $role);

    // Exécution de la requête
    $stmt->execute();

    echo "Nouvel utilisateur créé avec succès.";
?>
