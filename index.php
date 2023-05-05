<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <?php include('header.html') ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site E-commerce</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="index.js">
    </head>
    <body>
        <article>
            <?php require "carrousel.php" ?>
        </article>
        <box>
        <form action="produit.php">
            <input type="submit" value="Produit" />
        </form>
        </box>
    </body>
</html>