<?php
    session_start();
    require_once "database.php";
    require_once "header.php";
    var_dump($_SESSION["cart"]);
    $ids = array_keys($_SESSION["cart"]);
    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
                          INNER JOIN images i ON p.image_id = i.image_id
                          WHERE p.product_id = $id");                           
    var_dump($ids);
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
                    <tr><td class="empty">Votre panier est vide</td></tr>
                    <tr>
                        <th>Total:€</th>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
