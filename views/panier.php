<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    require_once "database.php";
    $ids = array_keys($_SESSION["cart"]);
    $idsString = implode(",", $ids);
    $stmt = $conn->query("SELECT * FROM products WHERE product_id IN ($idsString)");  
    $product = $stmt->fetch();

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
                    <tr>
                        <td class="empty">Votre panier est vide</td>
                    </tr>
                    <tr>
                        <td><img src="" width="40px"></td>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["price"]?>€</td>
                        <td><?=$_SESSION["cart"][$product["product_id"]]?></td>
                        <td><a href=""><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
                    </tr>
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
