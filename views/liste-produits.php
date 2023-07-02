<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title>Produits</title>
        <link rel="stylesheet" href="css/contact.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <?php
           $stmt = $pdo->query("SELECT * FROM users");
           while ($row = $stmt->fetch()) {
               echo "Product ID: " . $row['product_id'] . "<br>";
               echo "Category ID: " . $row['category_id'] . "<br>";
               echo "Image ID: " . $row['image_id'] . "<br>";
               echo "Name: " . $row['name'] . "<br>";
               echo "Description: " . $row['description'] . "<br>";
               echo "Material: " . $row['material'] . "<br>";
               echo "Quantity: " . $row['quantity'] . "<br>";
               echo "Price: " . $row['price'] . "<br>";
               echo "<br>";
           }
    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>