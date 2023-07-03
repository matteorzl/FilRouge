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
        <div class="panier">
            <section>
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Supprimer</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><img src="images/delete/delete.png"></td>
                    </tr>
                    <tr>
                        <th>Total: </th>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
