<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../compte.php');
    exit();
  }

require_once "header.php";
require_once "../database.php";

if (isset($_GET["del"])) {
    $id_del = $_GET["del"];
    
    $conn->query("DELETE FROM products WHERE product_id = $id_del");
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="js/dashboard.js">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="title-button">
            <h2>Produits</h2>
            <button class="createproduct" type="button" href="create/createproduct.php">Créer Produit</button>
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Matériau</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
                <?php
                    $stmt = $conn->query("SELECT * FROM products");
                    while (($row = $stmt->fetch())) {?>
                        <form method="post">
                            <tr class="info_produit">
                                <tr>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['description']?></td>
                                    <td><?=$row['material']?></td>
                                <?php if($row['quantity'] > 1): ?>
                                    <td> En stock </td>
                                <?php else: ?>
                                    <td> En rupture </td>
                                <?php endif; ?>
                                    <td><?=$row['price']?></td>
                                    <td class="button">
                                        <button class="modifyproduct" type="submit" action="modify/modifyproduct.php?id=<?=$row['product_id']?>">Modifier</button>
                                        <form method="post" action="products.php?del=<?=$row['product_id']?>">
                                            <button class="deleteproduct" type="button" onclick="confirmDelete(<?=$row['product_id']?>)">Supprimer</button>
                                        </form>
                                        <script>
                                            function confirmDelete(product_id) {
                                                if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                                                    window.location.href = 'products.php?del=' + product_id;
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            </tr>
                        </form>
                <?php 
                    }
                ?>
            </table>
        </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>