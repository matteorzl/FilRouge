<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../compte.php');
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
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="js/dashboard.js">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
    <h2>Carrousel</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <?php
            $stmt = $conn->query("SELECT * FROM carousel");

            while (($row = $stmt->fetch())) {?>
                <form method="post">

                    <tr class="info_category">
                        <tr>
                            <td><?=$row['carousel_id']?></td>
                            <td><?=$row['images']?></td>
                            <td class="button_category">
                                <button class="modifycarousel" type="submit" action="modify/modifycarousel.php?id=<?=$row['carousel_id']?>">Modifier</button>
                                <button class="deletecarousel" type="submit" action="delete/deletecarousel.php?id=<?=$row['carousel_id']?>">Supprimer</button>
                            </td>
                        </tr>
                    </tr>
                </form>
        <?php 
            }
        ?>
        </table>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>