<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "database.php";

// Récupérer les catégories depuis la table "categorie"
$sqlCategories = "SELECT * FROM categories";
$stmtCategories = $conn->query($sqlCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
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
    <?php foreach ($categories as $row) { ?>
        <div class="column">
            <a href="liste-produits.php?category=<?php echo $row['category_id']; ?>" class="category-link">
                <div class="image-wrapper">
                    <img src="<?php echo $row['image']; ?>" width="150" class="img_category">
                    <div class="image-text">
                        <h4><?php echo $row['name']; ?></h4>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>
<footer>
    <?php require "footer.php" ?>
</footer> 
</body>
</html>
