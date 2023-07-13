<?php  
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "database.php";
    $id = $_GET['id'];

    $stmt = $conn->query("SELECT p.* FROM products p WHERE p.product_id = $id");
    $product = $stmt->fetch();
    if(empty($stmt)){
        echo "<script>alert(\"Ce produit n'existe pas\")</script>";
    }
    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <link rel="stylesheet" href="css/produit.css">
       
    </head>
    <body>
        <article>
            <form action="ajout-produit.php?id=<?=$id?>" method="post">
                <div class="page">
                    <div class ="block">
                        <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": true, "imagesLoaded":true}'>
                            <div class="carousel-cell">
                                <img class="w3-image" src="<?php echo $product['image1']; ?>">
                            </div>
                            <div class="carousel-cell">
                                <img class="w3-image" src="<?php echo $product['image2']; ?>">
                            </div>
                            <div class="carousel-cell">
                                <img class="w3-image" src="<?php echo $product['image3']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="produit_details">
                        <div class="detail">
                            <div class ="nom"><h1><?=$product["name"]?></h1></div>
                            <div class ="stock">
                                <?php if($product["quantity"] > 1):?>
                                    <p> En stock</p>
                                <?php else:?>
                                    <p> En rupture de stock </p>
                                <?php endif?>
                            </div>
                            <div class=description>
                                <p><?=$product['description']?><p>
                            </div> 
                        </div>
                        <div class="prix_add">
                            <div class = "prix"><h> <?=$product["price"]?> €</h></div>    
                            <div class = "add_items">
                            <?php if($product["quantity"] > 1): ?>
                                <button class="button_add" type="submit">Ajouter au panier</button>
                            <?php else: ?>
                                <button class="button_add" type="submit" disabled>Ajouter au panier</button>
                            <?php endif ?>    
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </article>
        <article>
            <div class ="produits_similaires">
                <div class="text">produits similaires</div>
                    <div class="produits_sim">
                    <?php
                    $cat = $product["category_id"];
                    $stmt = $conn->query("SELECT p.* FROM products p
                                        WHERE p.category_id = $cat AND WHERE NOT p.product_id = $id");
                    $counter = 1; // Compteur pour limiter l'affichage à 3 produits

                    while ($products = $stmt->fetch()) {
                        ?> 
                    <div class="produit">
                        <div class="nom_prod"><?php $products['name'] ?></div>
                        <div class="img_prod"><?php $products['image1'] ?></div>
                        <div class="prix_prod"><?php $products['price'] ?></div>
                    </div>
                    <?php
                            $counter++;

                            if ($counter > 3) {
                                break; // Sortir de la boucle après avoir affiché 3 produits
                            }
                    }?>
                </div>
            </div>
        </article>
    </body>
</html>
