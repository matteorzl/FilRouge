<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once "database.php";

    $order_id = $_GET["id"];

    // Récupérer les catégories depuis la table "order"
    $sqlorder = "SELECT * FROM [orders-product] WHERE order_id = $order_id";
    $stmtorder = $conn->query($sqlorder);
    $order = $stmtorder->fetchAll(PDO::FETCH_ASSOC);

    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/orderproduct.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            $totalPrice = 0; // Variable pour stocker le prix total de la commande
            foreach ($order as $row) {
                $productId = $row["product_id"];
                $stmt = $conn->prepare("SELECT [name], image1 FROM products WHERE product_id = :productId");
                $stmt->bindParam(':productId', $productId);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                $totalPrice += $row['price']; // Ajouter le prix du produit au total
        ?>
        <div class="product">
            <div class="produit_img">
                <img src="<?php echo $product['image1']; ?>" width="150" class="img_produit">
            </div>
            <div class="info_produit">
                <h4><?php echo $product['name']; ?></h4>
            </div>
            <div class="quantite_prix">
                <h4><?php echo $row['price']; ?>€</h4>
                <p><?php echo $row['quantity']; ?></p>
            </div>
        </div>
        <?php 
            }
        ?>
        <div class="rising">
            <div class="total">
                <h4>Total <?php echo $totalPrice; ?>€</h4>
            </div>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
