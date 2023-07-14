<?php
session_start();
require_once "header.php";
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['nom'];
    $email = $_POST['mail'];
    $message = $_POST['message'];

    // Préparer la requête SQL pour insérer les données dans la table contacts
    $sql = "INSERT INTO contacts ([name], [mail], [text]) VALUES (?, ?, ?)";
    $params = array($name, $email, $message);

    try {
        // Exécuter la requête avec les paramètres
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Afficher un message de succès
        echo '<p>Votre message a bien été envoyé.</p>';
    } catch (PDOException $e) {
        // Afficher l'erreur SQL
        echo "Erreur SQL : " . $e->getMessage() . "<br>";
        echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
        echo "Informations complémentaires : ";
        print_r($stmt->errorInfo());
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <link rel="stylesheet" href="css/contact.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Contactez-nous</h1>
        <form method="post">
            <div class="items">
                <input type="text" placeholder="Entrez votre nom" name="nom" required/>
                <input type="email" placeholder="Entrez votre adresse mail" name="mail" required/>
                <textarea class="text" placeholder="Entrez votre texte" name="message" required></textarea>
                <button class="btn btn-primary w-100 py-2" type="submit">Envoyer</button>
            </div>
        </form>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
