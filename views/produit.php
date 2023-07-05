<?php
    require_once "database.php";
    session_start();
    $id = $_GET['id'];

    $stmt = $conn->query("SELECT p.*, i.bin FROM products p
        INNER JOIN images i ON p.image_id = i.image_id
        WHERE p.product_id = $id");
    $product = $stmt->fetch();
    
    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>  
        <?php include('header.html') ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <title>Produit</title>
        <link rel="stylesheet" href="css/produit.css">
       
    </head>
    <body>
        <article>
            <div class="page">
                <div class ="block">
                    <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": true, "imagesLoaded":true}'>
                        <div class="carousel-cell">
                            <img class="w3-image" src="<?php echo $product['bin']; ?>">
                        </div>
                        <div class="carousel-cell">
                            <img class="w3-image" src="<?php echo $product['bin']; ?>">
                        </div>
                        <div class="carousel-cell">
                            <img class="w3-image" src="<?php echo $product['bin']; ?>">
                        </div>
                    </div>
                </div>
                <div class="produit_details">
                        <div class="detail">
                            <div class ="nom"><h1><?=$product["name"]?></h1></div>
                            <div class ="stock">
                                <?php if($product["quantité"] > 1):?>
                                 <p> En stock</p>
                                <?php else:?>
                                 <p> En rupture de stock </p>
                                <?php endif?>
                            </div>
                            <div class=description>
                                <p>Chaise en bois massif d'hetre<p>
                            </div> 
                        </div>
                        <div class="prix_add">
                            <div class = "prix"><h> <?=$product["price"]?> </h></div>    
                            <div class = "add_items">
                            <?php if($product["quantité"] > 1): ?>
                                <button class="button_add" type="submit">Ajouter au panier</button>
						    <?php else: ?>
							    <button class="button_add" type="submit" disabled>Ajouter au panier</button>
						    <?php endif ?>    
                            </div>
                        </div>
                </div>
            </div>
        </article>
        <!-- <?php
        // $cat = $product["categorie"];
        // $stmt = $conn->query("SELECT p.*, i.bin FROM products p
        // INNER JOIN images i ON p.image_id = i.image_id
        // WHERE p.categorie = $cat");
        // $product = $stmt->fetch();
        ?>  -->
        <article>
            <div class ="produits_similaires">
                <div class="text">produits similaires</div>
                <div class="produits_sim">
                    <div class="produit produit_1">
                        <div class="nom_prod_1">sdvsv</div>
                        <div class="img_prod_1">sdvsv</div>
                        <div class="prix_prod_1">sdvds</div>
                    </div>
                    <div class="produit produit_2">
                        <div class="nom_prod_2">sdvvs</div>
                        <div class="img_prod_2">sdvdsv</div>
                        <div class="prix_prod_2">sdvsdvs</div>
                    </div>
                    <div class="produit produit_3">
                        <div class="nom_prod_3">vdsv</div>
                        <div class="img_prod_3">sdvsvsd</div>
                        <div class="prix_prod_3">sdvsdv</div>
                    </div>
                </div>
            </div>
        </article>
    </body>
</html>
