<!--Test-->
<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
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
           $stmt = $conn->query("SELECT * FROM products");
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
           $img = $conn->query("SELECT * FROM images");
           while ($row = $img->fetch()) {
               echo "image id: " . $row['image_id'] . "<br>";
               <img src="./image/<?php echo $data['filename']; ?>">
           }
    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>