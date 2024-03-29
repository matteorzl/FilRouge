<?php
    session_start();
    require_once "database.php";

    $user_id = $_GET["id"];

    if($_SESSION["users"]["user_id"] !== $user_id){
        header('Location: compte.php');
    }

    // Récupérer les catégories depuis la table "order"
    $sqlorder = "SELECT * FROM orders WHERE user_id = $user_id";
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
            $deliveryId = $row["delivery_id"];
            $deliveryaddress = $conn->query("SELECT address_1 FROM deliveries WHERE delivery_id = $deliveryId");
            $deliveryRow = $deliveryaddress->fetch(PDO::FETCH_ASSOC);
        ?>
            <form method="post" action="orderproduct.php?id=<?= $row['order_id'] ?>" class="form_list_prod">
                <button type="submit" class="button_liste">
                    <div class="produit_img">
                        <h4>Commande numero: <?= $row["order_id"] ?></h4>
                    </div>
                    <div class="info_produit">
                        <p><?= $row['date_order'] ?></p>
                        <p><?= $deliveryRow['address_1'] ?></p>
                        <p><?= $row['date_delivery'] ?></p>
                    </div>
                    <div class="quantite_prix">
                        <h4><?= $row['status'] ?></h4>
                        <p>Cliquer pour afficher les details</p>
                    </div>
                </button>
            </form>
        <?php
        }
    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
