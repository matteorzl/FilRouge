<?php
if (isset($_SESSION['username'])) {
    header('Location: https://mjfilrouge.azurewebsites.net/login.php?');
    die();
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <?php include('header.html') ?>
        <title>Panier</title>
    </head>
    <body>
    </body>
</html>
