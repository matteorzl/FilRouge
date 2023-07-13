<?php
    session_start();
    if (isset($_SESSION['message'])) {
    echo "{$_SESSION['message']}";
    unset($_SESSION['message']);
    }
    require_once "database.php";
    require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/carousel.css">
        <link rel="stylesheet" href="js/index.js">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    </head>
    <body>
        <article>
            <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": 5000, "imagesLoaded":true, "freeScroll":true}'>
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
        </article>
        <div class="text-index">
            <h2>VENANT DES HAUTES TERRES D'ÉCOSSE NOS MEUBLES SONT IMMORTELS<h2>
        </div>
        <div class="row">
            <div class="column">
                <img src="images/category/chair.jpg" alt="Chair" style="width:100%">
            </div>
            <div class="column">
                <img src="images/category/desk.jpg" alt="Desk" style="width:100%">
            </div>
            <div class="column">
                <img src="images/category/table.jpg" alt="Table" style="width:100%">
            </div>
            <?php
              // Préparer la requête SQL
            $sqlCategories = "SELECT * FROM categories"; // Condition de départ

            // Exécuter la requête avec les paramètres de filtrage
            $stmtCategories = $conn->prepare($sqlCategories);
            $stmtCategories->execute($params);
            $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $row) {?>
                        <div class="category_img">
                            <img src="<?php echo $row['image']; ?>" width="150" class="img_category">
                        </div>
                           <div class="info_category">
                            <h4><?=$row['name']?></h4>
                        </div>
            <?php 
            }
            ?>
        </div>
        <footer>
        <?php require "footer.php" ?>
        </footer> 
    </body>
</html>