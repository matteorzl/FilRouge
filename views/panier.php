<?php
    session_start();
    require_once "database.php";
    if (isset($_SESSION['users'])) {
    header('Location: login.php?');
    exit();
    }
    require_once "header.php";

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <title>Panier</title> 
        <link href="css/panier.css" rel="stylesheet">
    </head>
    <body>
        <section>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Supprimer</th>
                </tr>
                <tr></tr>
                <tr>
                    <th>Total: </th>
                </tr>
            </table>
        </section>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
