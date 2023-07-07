<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    require_once "database.php";
    $ids = array_keys($_SESSION["cart"]);
    $idsString = implode(",", $ids);
    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
    INNER JOIN images i ON p.image_id = i.image_id
    WHERE p.product_id IN ($idsString)");  
    $products = $stmt->fetch();

    if(isset($_GET["del"])){
        $id_del = $_GET["del"];
        if($_SESSION["cart"][$id_del] < 1){
            unset($_SESSION["cart"][$id_del]);
        }else{
            $_SESSION["cart"][$id_del]--;
        }
    }

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
                        <td><img src="<?php echo $products['bin']; ?>" width="40px"></td>
                        <td><?=$products["name"]?></td>
                        <td><?=$products["price"]?>€</td>
                        <td><?=$_SESSION["cart"][$products["product_id"]]?></td>
                        <td><a href="panier.php?del=<?php echo $products["product_id"]?>"><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
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
