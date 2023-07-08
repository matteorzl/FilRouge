<?php
session_start();

require_once "header.php";
require_once "../database.php";
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
    <h2>Produits</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
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
                        <td><a href="produit.php?id=<?=$row['product_id']?>" class="id_produit">Modifier</a></td>
                        <td><a href="produit.php?id=<?=$row['product_id']?>" class="id_produit">Supprimer</a></td>
                        </tr>
                    </tr>
                </form>
        <?php 
            }
        ?>
        </table>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>