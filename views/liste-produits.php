<!--Test-->
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
        $stmt = $conn->query("SELECT * FROM products");
        $img = $conn->query("SELECT * FROM images");

        while (($row = $stmt->fetch()) && ($rowImg = $img->fetch())) {?>
            <form method="post">
                <div>
                    <img src="<?php echo $rowImg['bin']; ?>">
                </div>
                <div class="info_produit">
                    <p><?=$row['name']?></p>
                    <p><?=$row['description']?></p>
                    <p><?=$row['material']?></p>
                </div>
                <div>
                    <?php if($row['quantity'] > 1):?>
                        <p> En stock </p>
                    <? else:?>
                        <p> En rupture </p>
                    <? endif?>
                    <p><?=$row['price']?></p>
                    <a href="produit.php?id=<?=$row['product_id']?>" class="id_produit">Voir produit</a>
                </div>
            </form>
        <?php }?>
    
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>