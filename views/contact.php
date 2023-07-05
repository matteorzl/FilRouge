<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <link rel="stylesheet" href="css/contact.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Contactez-nous</h1>
        <div class="items">
            <input type="text" placeholder="Entrez votre nom" name="Nom"/>
            <input type="email" placeholder="Entrez votre adresse mail" name="Mail"/>
            <textarea class="text" placeholder="Entrez votre texte" name="Text"></textarea>
            <button class="btn btn-primary w-100 py-2" type="submit">Envoyer</button>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>