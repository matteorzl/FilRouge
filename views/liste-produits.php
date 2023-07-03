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
        $stmt = $pdo->query("SELECT * FROM products");
        $img = $pdo->query("SELECT * FROM images");
        
        while ($row = $stmt->fetch() && $rowImg = $img->fetch()) {
            ?><img src="<?php echo $rowImg['bin']; ?>"><?php
            echo $row['name']."<br>";
            echo $row['description']."<br>";
            echo $row['material']."<br>";
            if($row['quantity'] > 1) {
                echo "En stock";
            } else {
                echo "En rupture";
            }
            echo $row['price']."<br>";
            echo "<br>";
        }
    ?>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>