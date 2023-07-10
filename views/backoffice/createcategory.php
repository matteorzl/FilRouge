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
        <link rel="stylesheet" href="css/createcategory.css">
    </head>
    <body>
        <div class="createcategory">
            <h1 class="titleCreateCategory">Créer Categorie</h1>
            <form action="../category.php" method="post">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>

                <label for="image">Image</label>
                <input type="file" id="image" name="image" required>

                <input type="submit" class="createbutton" value="Créer Catégorie">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>