<?php
    session_start();
    require_once "database.php";
    require_once "header.php";
    $ids = array_keys($_SESSION["cart"]);
    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
                          INNER JOIN images i ON p.image_id = i.image_id
                          WHERE p.product_id = $ids");  
    $product = $stmt->fetch();
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
                    <tr>
                        <td><img src="<?php echo $product['bin']; ?>" width="40px"></td>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["price"]?>€</td>
                        <td><?=$_SESSION["cart"][$product["product_id"]]?></td>
                        <td><a href="panier.php?del=<?php echo $product["product_id"]?>"><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
                    </tr>
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
