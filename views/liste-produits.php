<!--Test-->
<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/liste-produits.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <aside>
        <div class="aside_category">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, velit doloribus exercitationem voluptatem eum iure distinctio officia autem nisi, ut maiores odio reiciendis quis omnis? Maiores dolorem inventore architecto saepe.
        </div>
    </aside>
    <?php
        $stmt = $conn->query("SELECT * FROM products");
        $img = $conn->query("SELECT * FROM images");

        while (($row = $stmt->fetch()) && ($rowImg = $img->fetch())) {?>
            <form method="post" action="produit.php?id=<?=$row['product_id']?>" class="form_list_prod">
                <button type="submit" class="button_liste_produit">
                    <div class="list_prod">
                        <div class="produit_img">
                            <img src="<?php echo $rowImg['bin']; ?>" width="100">
                        </div>
                        <div class="info_produit">
                            <p><?=$row['name']?></p>
                            <p><?=$row['material']?></p>
                            <p><?=$row['description']?></p>
                        </div>
                        <div class="quantite_prix">
                            <p><?=$row['price']?></p>
                            <?php if($row['quantity'] > 1): ?>
                                <p> En stock </p>
                            <?php else: ?>
                                <p> En rupture </p>
                            <?php endif; ?>
                        </div>
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