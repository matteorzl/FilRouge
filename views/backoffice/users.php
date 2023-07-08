<?php
session_start();

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
    <h2>Produits</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <?php
            $stmt = $conn->query("SELECT * FROM users");

            while (($row = $stmt->fetch())) {?>
                <form method="post">
                    <tr class="info_user">
                        <tr>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['mail']?></td>
                            <td><?=$row['role']?></td>
                            <td><button class="modifyuser" type="submit" action="modify/modifyuser.php?id=<?=$row['user_id']?>">Modifier</button></td>
                            <td><button class="deleteuser" type="submit" action="delete/deleteuser.php?id=<?=$row['user_id']?>">Supprimer</button></td>
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