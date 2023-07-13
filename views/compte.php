<?php
    session_start();
    if(!isset($_SESSION["role"]) == 0) {
        header("../index.php");
    }

    require_once "database.php";
    require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
                <div class="button_log">
                    <?php if(!isset($_SESSION["users"])):?>
                        <div class="log">
                            <form action="login.php">
                                <button class="button" type="submit" name="login" value="Login">Connexion</a></button>
                            </form>
                            <form action="register.php" >
                                <button class="button" type="submit" name="signup" value="signup">Inscription</a></button>
                            </form>
                        </div>
                    <?php else:?>
                        <div class="logout">
                            <form method="post" action="modify_user.php?id=<?php $_SESSION["users"]["user_id"]?>">
                            <button class="button" type="submit" name="modify_user" value="Modify_user">Modifier mes informations</button>
                            </form>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </article>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>