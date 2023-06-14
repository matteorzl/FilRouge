<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head> 
        <?php include('header.html') ?>
        <title>Compte</title>
        <link rel="stylesheet" href="compte.css">
    </head>
    <body>
        <article class ="compte_info">
            <div class ="info_compte">
                <div class="info_perso">
                    <div class="nom">Nom : </div>
                    <div class="prenom">Prenom : </div>
                    <div class="mail">Adresse mail : </div>
                    <div class="mdp">Mot de passe : </div>
                </div>
                <div class="adresses">
                    <h1> Adresse de livraison : </h1>
                    <select class="livraison">
                        <option value="adl1">zvzvze</option>
                        <option value="adl2">zvzvrz</option>
                        <option value="adl3">dvzz</option>
                    </select>
                    <h2> Adresse de facturation : </h2>
                    <select class="facturation">
                        <option value="adf1">zvzvze</option>
                        <option value="adf2">zvzvrz</option>
                        <option value="adf3">dvzz</option>
                    </select>
                </div>
                <div class="methode_paiement">
                    <h2> Cartes de paiement : </h2>
                    <select class="cartes">
                        <option value="cb1">zvzvze</option>
                        <option value="cb2">zvzvrz</option>
                        <option value="cb3">dvzz</option>
                    </select>
                </div>
            </div>
            <div class="info_commandes">

            </div>
        </article>
    </body>
</html>