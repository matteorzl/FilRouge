<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <link rel="stylesheet" href="css/contact.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <?php
    
    try {
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        } else {
            echo "Aucun produit trouvé dans la table.";
        }
        
        $pdo = null;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>