<?php
    session_start();
    require_once "database.php";
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
                    <div class="nom"><h> Nom : <?=$_SESSION["users"]["lastname"]?></h></div>
                    <div class="prenom"><h> Prénom : <?=$_SESSION["users"]["firstname"]?></h></div>
                    <div class="mail"><h> Adresse mail : <?=$_SESSION["users"]["mail"]?></h></div>
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
                </div>
            </div>
        </article>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>