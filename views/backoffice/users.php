<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../compte.php');
    exit();
  }

require_once "header.php";
require_once "../database.php";

if (isset($_GET["del"])) {
    $id_del = $_GET["del"];
    
    $conn->query("DELETE FROM users WHERE user_id = $id_del");
}
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
    <h2>Utilisateur</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <?php
            $stmt = $conn->query("SELECT * FROM users");

            while (($row = $stmt->fetch())) {?>
                    <tr class="info_user">
                        <tr>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['mail']?></td>
                            <td><?=$row['role']?></td>
                            <td>
                                <form method="post" action="modify/modifyuser.php?id=<?=$row['user_id']?>">
                                    <button class="modifyuser" type="submit">Modifier</button>
                                </form>
                                <form method="post" action="users.php?del=<?=$row['user_id']?>">
                                    <button class="deleteuser" type="button" onclick="confirmDelete(<?=$row['user_id']?>)">Supprimer</button>
                                </form>

                                <script>
                                    function confirmDelete(user_id) {
                                        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                                            window.location.href = 'users.php?del=' + user_id;
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                    </tr>
        <?php 
            }
        ?>
        </table>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>