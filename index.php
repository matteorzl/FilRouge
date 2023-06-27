<?php
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site E-commerce</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="index.js">
    </head>
    <body>
        <article>
            <?php require "carousel.php" ?>
        </article>
        <box>
        <form action="produit.php">
            <input type="submit" value="Produit" />
        </form>
        </box>
        <box>
        <form action="database.php">
            <input type="submit" value="Database" />
        </form>
        </box>
    </body>
</html>