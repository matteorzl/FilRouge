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
        <article class=articlecarousel>
        <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": 5000, "imagesLoaded":true, "freeScroll":true}'>
            <?php
            $stmtCarousel = $conn->query("SELECT image1, image2, image3 FROM carousel");
            $rowCarousel = $stmtCarousel->fetch();

            if ($rowCarousel) {
                $image1 = $rowCarousel['image1'];
                $image2 = $rowCarousel['image2'];
                $image3 = $rowCarousel['image3'];

                echo '<div class="carousel-cell">';
                echo '<img class="w3-image" src="' . $image1 . '">';
                echo '</div>';

                echo '<div class="carousel-cell">';
                echo '<img class="w3-image" src="' . $image2 . '">';
                echo '</div>';

                echo '<div class="carousel-cell">';
                echo '<img class="w3-image" src="' . $image3 . '">';
                echo '</div>';
            } else {
                echo "Aucune image trouvée dans le carrousel.";
            }
            ?>
        </div>
        </article>
        <div class="text-index">
            <h2>VENANT DES HAUTES TERRES D'ÉCOSSE NOS MEUBLES SONT IMMORTELS<h2>
        </div>
        <div class="row">
        <?php
            // Préparer la requête SQL
            $sqlCategories = "SELECT * FROM categories"; // Condition de départ

            // Exécuter la requête avec les paramètres de filtrage
            $stmtCategories = $conn->prepare($sqlCategories);
            $stmtCategories->execute($params);
            $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $row) {?>
                <div class="column">
                    <div class="image-wrapper">
                        <img src="<?php echo $row['image']; ?>" width="150" class="img_category">
                        <div class="image-text">
                            <h4><?=$row['name']?></h4>
                        </div>
                    </div>
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