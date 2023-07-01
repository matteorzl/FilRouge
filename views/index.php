<?php
session_start();
require_once "header.php";
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site E-commerce</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="js/index.js">
    </head>
    <body>
        <article>
            <?php require "carousel.php" ?>
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
        </div> 
    </body>
</html>

<?php require "footer.php" ?>