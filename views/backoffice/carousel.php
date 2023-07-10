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
        <link rel="stylesheet" href="css/carousel.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
    <h2>Carrousel</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <?php
            $stmt = $conn->query("SELECT image1,image2,image3 FROM carousel");

            while (($row = $stmt->fetch())) {?>
                <?=$row['image1']?>
                <?=$row['image2']?>
                <?=$row['image3']?>
        <?php 
            }
        ?>
        </table>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>