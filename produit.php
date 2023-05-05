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
        <link rel="stylesheet" href="produit.css">
       
    </head>
    <body>
        <article>
            <div class="page">
                <div class ="block">
                    <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": true, "imagesLoaded":true}'>
                        <div class="carousel-cell">
                            <img class="w3-image" src="https://smash-images.photobox.com/original/5f04c1b41fd48d1b10ff27dfc90548bf13608845_Large-Print-lifestyle-3_1-2600.jpg">
                        </div>
                        <div class="carousel-cell">
                            <img class="w3-image" src="https://smash-images.photobox.com/original/bca8e5fa7862a2cfaefc300c5b572e7a6dc6f3f3_Standard-Prints-lifestyle-3_1-2600.jpg">
                        </div>
                        <div class="carousel-cell">
                            <img class="w3-image" src="https://smash-images.photobox.com/original/a422aed1a721e933961b19ea9e47e07fc71e0699_Acrylic-Prints-lifestyle-3_1-2600.jpg">
                        </div>
                    </div>
                </div>
                <div class="produit_details">
                        <div class="detail">
                            <div class ="nom"><h1> Chaise </h1></div>
                            <div class ="stock"><p> En stock </p></div>
                            <div class=description>
                                <p>Chaise en bois massif d'hetre<p>
                            </div> 
                        </div>
                    <div class = "prix"><h1> 12000€ </h1></div>    
                </div>
            </div>
        </article>
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
