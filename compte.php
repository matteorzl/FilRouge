<?php
session_start();

if(!isset($_SESSION['email'])) {
    header('Location: /login');
  }

  require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <title>Compte</title>
        <link rel="stylesheet" href="compte.css">
    </head>
    <body>
        <article class ="compte_info">
            <div class ="info_compte">
                <div class="info_perso">
                    <div class="nom"><h> Nom : </h></div>
                    <div class="prenom"><h> Prénom : </h></div>
                    <div class="mail"><h> Adresse mail : </h></div>
                    <div class="mdp"><h> Mot de passe : </h></div>
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
                <div class="deconnexion">
                    <form action="logout.php" method="post">
                        <button class="button" type="submit" name="logout" value="Log out">Déconnexion</button>
                    </form>
                </div>
            </div>
        </article>
    </body>
</html>