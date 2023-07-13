<?php
session_start();
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
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
        <link rel="stylesheet" href="css/products.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="title-button">
            <h2>Produits</h2>
            <div class="createproductbox">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                <a href="createproduct.php" class="createproduct">Créer Produit</a>
            </div>
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Matériau</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th> </th>
                </tr>
                <?php
                    $stmt = $conn->query("SELECT p.*, m.name AS material_name FROM products p JOIN materials m ON p.material_id = m.material_id");
                    while (($row = $stmt->fetch())) {?>
                        <form method="post">
                            <tr class="info_produit">
                                <td><?=$row['name']?></td>
                                <td><?=$row['description']?></td>
                                <td><?=$row['material_name']?></td>
                                <td><?=$row['quantity']?></td>
                                <td><?=$row['price']?></td>
                                <td class="btn-mod-del">
                                <button class="modifyproduct" type="button" onclick="window.location.href='modifyproduct.php?id=<?=$row['product_id']?>'">Modifier</button>
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
