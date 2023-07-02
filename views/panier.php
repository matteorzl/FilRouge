<?php
    session_start();
    require_once "database.php";
    if (isset($_SESSION['users'])) {
    header('Location: login.php?');
    exit();
    }
    require_once "header.php";

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <title>Panier</title>
    </head>
    <body>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
