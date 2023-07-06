<?php
    session_start();
    require_once "database.php";
    // $stmt = $conn->query("SELECT p.*, i.bin FROM products p
    //     INNER JOIN images i ON p.image_id = i.image_id
    //     WHERE p.product_id = 17");
    // $product = $stmt->fetch();
    //$stmt = $conn->query("SELECT * FROM products WHERE product_id = 17");
    //$product = $stmt->fetch();

    if(isset($_GET["del"])){
        $id_del = $_GET["del"];
        if($id_del < 1){
            unset($_SESSION["panier"][$id_del])
        }else{
            $_SESSION["panier"][$id]--;
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
                    <?php
                    $total =0;

                    $ids = array_keys($_SESSION["panier"]);
                    if(empty($ids)):?>
                    <tr><td>Votre panier est vide</td></tr>
                    <?php else:{
                        $stmt = $conn->query("SELECT p.*, i.bin FROM products p
                        INNER JOIN images i ON p.image_id = i.image_id
                        WHERE p.product_id IN (".implode(",","$ids").")");

                        foreach($stmt as $product):
                            $total += $product["price"] * $_SESSION["panier"][$product["product_id"]];
                    ?>
                    <tr>
                        <td><img src="<?php echo $product['bin']; ?>" width="40px"></td>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["price"]?>€</td>
                        <td><?=$_SESSION["panier"][$product["product_id"]]?></td>
                        <td><a href="panier.php?del=<?php $product["product_id"]?>"><img src="images/delete/delete.png" width="40px" padding="8px 0"></a></td>
                    </tr>
                    <?php endforeach: }?>
                    <tr>
                        <th>Total:<?php $total ?>€</th>
                    </tr>
                </table>
            </section>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
