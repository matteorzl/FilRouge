<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if(!isset($_SESSION["role"]) == 0) {
        header("../index.php");
    }
    $id = $_SESSION["users"]["user_id"];
    
    require_once "database.php";

    $deliveries = $conn->query("SELECT address_1 , address_2 FROM deliveries WHERE user_id = $id")->fetchAll(PDO::FETCH_ASSOC);
    $billings = $conn->query("SELECT address_1 , address_2 FROM billings WHERE user_id = $id")->fetchAll(PDO::FETCH_ASSOC);
    $sqlpayments = "SELECT * FROM payments WHERE user_id = $id";
    $stmtpayments = $conn->query($sqlpayments);
    $payments = $stmtpayments->fetchAll(PDO::FETCH_ASSOC); 
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
                            <option><?php echo $deliveries[0]['address_1']; ?></option>
                            <option><?php echo $deliveries[0]['address_2']; ?></option>
                    </select>
                    <h> Adresse de facturation : </h>
                    <select class="facturation">
                        <option><?php echo $billings["address_1"]; ?></option>
                        <option><?php echo $billings["address_2"]; ?></option>
                    </select>
                </div>
                <div class="methode_paiement">
                    <h> Cartes de paiement : </h>
                    <select class="cartes">
                        <?php foreach ($payments as $payment): ?>
                            <option><?php echo $payment["number"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="info_commandes">
                <div class="commandes">
                    <button class="button" type="button" onclick="window.location.href='order.php?id=<?php echo $id ?>'">Mes commandes</button>
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
                            <button class="button" type="button" onclick="window.location.href='modifyuser.php?id=<?php echo $id ?>'">Modifier mes informations</button>
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