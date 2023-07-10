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
        <link rel="stylesheet" href="css/createuser.css">
    </head>
    <body>
        <div class="createuser">
            <h1 class="titleCreateUser">Créer Utilisateur</h1>
            <form action="../users.php" method="post">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required>
                
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required>
                
                <label for="description">Email</label>
                <input type="mail" id="mail" name="mail" required>

                <label for="pwd">Mot de passe</label>
                <input type="password" id="pwd" name="pwd" required>
                

                <label for="role">Rôle</label>
                    <select name="role" id="role">
                        <option value="">Utilisateur</option>
                        <option value="">Administrateur</option>
                    </select>
                </label>
                <input type="submit" class="createbutton" value="Créer utilisateur">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>