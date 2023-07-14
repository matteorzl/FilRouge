<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
  }

require_once "header.php";
require_once "../database.php";

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/category.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
    <?php
        // Récupérer les images du carrousel depuis la base de données
        $stmt = $conn->query("SELECT image1, image2, image3 FROM carousel");
        $row = $stmt->fetch();

        // Vérifier si les images existent dans la base de données
        if ($row) {
            $image1 = $row['image1'];
            $image2 = $row['image2'];
            $image3 = $row['image3'];

            // Afficher les images du carrousel avec le code HTML
            echo '<img src="' . $image1 . '" alt="Image 1">';
            echo '<img src="' . $image2 . '" alt="Image 2">';
            echo '<img src="' . $image3 . '" alt="Image 3">';
        } else {
            echo "Aucune image trouvée dans le carrousel.";
        }
    ?>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>