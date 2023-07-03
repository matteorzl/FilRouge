<?php
    session_start();
    require_once "database.php";
    if (isset($_SESSION['users'])) {
    header('Location: login.php?');
    exit();
    }
    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
        INNER JOIN images i ON p.image_id = i.image_id
        WHERE p.product_id = 17");
    $product = $stmt->fetch();
    //$stmt = $conn->query("SELECT * FROM products WHERE product_id = 17");
    //$product = $stmt->fetch();
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
                        <td><img src="<?php echo $product['bin']; ?>" width="40px"></td>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["price"]?></td>
                        <td><?=$product["quantity"]?></td>
                        <td><img src="images/delete/delete.png" width="40px" padding="8px 0"></td>
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
