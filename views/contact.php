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
        <form method="post">
            <div class="items">
                <input type="text" placeholder="Entrez votre nom" name="nom"/>
                <input type="email" placeholder="Entrez votre adresse mail" name="mail"/>
                <textarea class="text" placeholder="Entrez votre texte" name="message" required></textarea>
                <button class="btn btn-primary w-100 py-2" type="submit">Envoyer</button>
            </div>
        </form>
        <?php
    if (isset($_POST['message'])) {
        $retour = mail('julien.blanchon@limayrac.fr', 'Envoi depuis la page Contact', $_POST['message'], 'From: webmaster@projetfilrouge.fr' . "\r\n" . 'Reply-to: ' . $_POST['mail']);
        if($retour)
            echo '<p>Votre message a bien été envoyé.</p>';
    }
    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>