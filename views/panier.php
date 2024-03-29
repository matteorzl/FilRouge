<?php
    session_start();
    require_once "database.php";

    $total = 0;
    if(isset($_SESSION["cart"])){
        $ids = array_keys($_SESSION["cart"]);
        $idsString = implode(",", $ids);
    
        $stmt = $conn->query("SELECT * FROM products WHERE product_id IN ($idsString)");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //Affiche votre panier est vide en fonction de l'état du panier
    if (isset($_GET["del"])) {
        $id_del = $_GET["del"];
        if ($_SESSION["cart"][$id_del] < 1) {
            unset($_SESSION["cart"][$id_del]);
            if(empty($_SESSION["cart"])){
                unset($_SESSION["cart"]);
            }
        } else {
            $_SESSION["cart"][$id_del]--;
        }
    }

    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <link href="css/panier.css" rel="stylesheet">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <?php if(!isset($_SESSION["cart"]) || empty($_SESSION["cart"])): ?>
                        <div>
                            <div class="empty">Votre panier est vide</div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <?php if ($_SESSION["cart"][$product["product_id"]] > 0): ?>
                                <tr>
                                    <td><img src="<?php echo $product['image1']; ?>" width="40px"></td>
                                    <td><?=$product["name"]?></td>
                                    <td><?=$product["price"]?>€</td>
                                    <td><?=$_SESSION["cart"][$product["product_id"]]?></td>
                                    <td><a href="panier.php?del=<?php echo $product["product_id"]?>"><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
                                </tr>
                                <?php $total += $product["price"] * $_SESSION["cart"][$product["product_id"]]; 
                                      $_SESSION["total"]=["total" => $total];?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr class="total-row">
                        <th>Total: <?php echo $total ?>€</th>
                        <?php if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])): ?>
                            <th><a href="checkout.php" class="btn-payer" disabled>Payer</a></th>
                        <?php else: ?>
                            <th><a href="checkout.php" class="btn-payer">Payer</a></th>
                        <?php endif; ?>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
