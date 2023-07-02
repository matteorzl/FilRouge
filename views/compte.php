<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    session_start();
    require_once "database.php";
    if(!isset($_SESSION["users"])){
        header(Location: "login.php");
        exit();
    }
    require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Compte</title>
        <link rel="stylesheet" href="css/compte.css">
    </head>
    <body>
        <article class ="compte_info">
            <div class ="info_compte">
                <div class="info_perso">
                    <div class="nom"><h> Nom : <?=$_SESSION["users"]["nom"]?></h></div>
                    <div class="prenom"><h> Prénom : <?=$_SESSION["users"]["prenom"]?></h></div>
                    <div class="mail"><h> Adresse mail : <?=$_SESSION["users"]["email"]?></h></div>
                </div>
                <div class="adresses">
                    <h> Adresse de livraison : </h>
                    <select class="livraison">
                        <option value="adl1">zvzvze</option>
                        <option value="adl2">zvzvrz</option>
                        <option value="adl3">dvzz</option>
                    </select>
                    <h> Adresse de facturation : </h>
                    <select class="facturation">
                        <option value="adf1">zvzvze</option>
                        <option value="adf2">zvzvrz</option>
                        <option value="adf3">dvzz</option>
                    </select>
                </div>
                <div class="methode_paiement">
                    <h> Cartes de paiement : </h>
                    <select class="cartes">
                        <option value="cb1">zvzvze</option>
                        <option value="cb2">zvzvrz</option>
                        <option value="cb3">dvzz</option>
                    </select>
                </div>
            </div>
            <div class="info_commandes">
                <div class="commandes">
                    <button class="button">Vos commandes</button>
                </div>
                <div class="button_log">
                    <?php if(!isset($_SESSION["users"])):?>
                        <button class="button"><a href="login.php">Connexion</a></button>
                        <button class="button"><a href="register.php">Inscription</a></button>
                    <?php else:?>
                        <button class="button" type="submit" name="logout" value="Log out">Déconnexion</button>
                    <?php endif;?>
                </div>
            </div>
        </article>
    </body>
</html>