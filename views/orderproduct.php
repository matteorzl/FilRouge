<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once "database.php";

    $order_id = $_GET["id"];

    if($_SESSION["users"]["user_id"] !== $user_id){
        header('Location: compte.php');
    }

    // Récupérer les catégories depuis la table "order"
    $sqlorder = "SELECT * FROM [orders-product] WHERE order_id = $order_id";
    $stmtorder = $conn->query($sqlorder);
    $order = $stmtorder->fetchAll(PDO::FETCH_ASSOC);

    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/order.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            foreach ($order as $row) {
                $productId = $order["product_id"];
                $stmt = $conn->query("SELECT [name] AND image1 FROM products WHERE product_id = $productId");
                ?>
            <div class="produit_img">
                <img src="<?php echo $stmt['image1']; ?>" width="150" class="img_produit">
                    </div>
                       <div class="info_produit">
                        <h4><?=$stmt['name']?></h4>
                    </div>
                    <div class="quantite_prix">
                        <h4><?=$row['price']?>€</h4>
                        <p><?=$row['quantity']?></p>
                    </div>
            </div>
    <?php 
        }
    ?>

    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
