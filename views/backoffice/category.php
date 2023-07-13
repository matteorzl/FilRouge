<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
  }

require_once "header.php";
require_once "../database.php";

if (isset($_GET["del"])) {
    $id_del = $_GET["del"];
    
    $conn->query("DELETE FROM categories WHERE category_id = $id_del");
}
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
        <div class="title-button">
            <h2>Catégories</h2>
            <div class="createcategorybox">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                        <a href="createcategory.php" class="createcategory">Créer Catégorie</a>
            </div>
        </div>
        <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th> </th>
            </tr>
            <?php
                $stmt = $conn->query("SELECT * FROM categories");

                while (($row = $stmt->fetch())) {?>
                    <form method="post">
                        <tr class="info_category">
                            <tr>
                                <td><?=$row['category_id']?></td>
                                <td><?=$row['name']?></td>
                                <td class="btn-mod-del">
                                <button class="modifycategory" type="button" onclick="window.location.href='modifycategory.php?id=<?=$row['category_id']?>'">Modifier</button>
                                    <form method="post" action="category.php?del=<?=$row['category_id']?>">
                                        <button class="deletecategory" type="button" onclick="confirmDelete(<?=$row['category_id']?>)">Supprimer</button>
                                    </form>

                                    <script>
                                        function confirmDelete(category_id) {
                                            if (confirm('Êtes-vous sûr de vouloir supprimer cette categorie ?')) {
                                                window.location.href = 'category.php?del=' + category_id;
                                            }
                                        }
                                    </script>
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