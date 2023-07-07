<?php
    session_start();
    require_once "database.php";
    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
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
                    <?php
                        $total = 0;

                        var_dump($_SESSION["cart"]);

                        if(empty($_SESSION["cart"])):?>

                    <tr><td>Votre panier est vide</td></tr>
                    <tr>
                        <th>Total:<?php echo $total ?>€</th>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
