<?php
session_start();
error_reporting(E_ALL);

if(!isset($_SESSION["role"]) == 1) {
    header("../index.php");
}

require_once "header.php";
require_once "../database.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="js/index.js">
    </head>
    <body>
      <h1>TEST</h1>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>