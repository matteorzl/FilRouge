<?php
    session_start();
    require_once "database.php";

    $total = 0;

    $ids = array_keys($_SESSION["cart"]);
    $idsString = implode(",", $ids);

    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
        INNER JOIN images i ON p.image_id = i.image_id
        WHERE p.product_id IN ($idsString)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET["del"])) {
        $id_del = $_GET["del"];
        if ($_SESSION["cart"][$id_del] < 1) {
            unset($_SESSION["cart"][$id_del]);
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
                    <?php if (empty($products)): ?>
                        <tr>
                            <td class="empty">Votre panier est vide</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <?php if ($_SESSION["cart"][$product["product_id"]] > 0): ?>
                                <tr>
                                    <td><img src="<?php echo $product['bin']; ?>" width="40px"></td>
                                    <td><?=$product["name"]?></td>
                                    <td><?=$product["price"]?>€</td>
                                    <td><?=$_SESSION["cart"][$product["product_id"]]?></td>
                                    <td><a href="panier.php?del=<?php echo $product["product_id"]?>"><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
                                </tr>
                                <?php $total += $product["price"] * $_SESSION["cart"][$product["product_id"]]; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr>
                        <th>Total: <?php echo $total ?>€</th>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
