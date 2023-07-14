<?php
    session_start();
    require_once "header.php";
    require_once "database.php";
?>
<!doctype html>
<html lang="fr" dir="ltr">
  <head><script src="boostrap/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AIRNEIS</title>

    <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/icon.ico" />
  </head>
  <body>
      <main>
        <div class="header">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
              <img src="images\logo\logo.png" width="80px" height="60px" margin-right="15px">

              <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <?php if(($_SERVER['PHP_SELF']) == "/views/index.php"):?>
                  <li><a href="index.php" class="nav-link px-2 text-dark">Accueil</a></li>
                <?php else:?>
                  <li><a href="index.php" class="nav-link px-2 text-light">Accueil</a></li>
                <?php endif;?>
                
                <?php if(($_SERVER['PHP_SELF']) == "/views/liste-produits.php"):?>
                  <li><a href="liste-produits.php" class="nav-link px-2 text-dark">Produits</a></li>
                <?php else:?>
                  <li><a href="liste-produits.php" class="nav-link px-2 text-light">Produits</a></li>
                <?php endif;?>
                
                <?php if(($_SERVER['PHP_SELF']) == "/views/contact.php"):?>
                  <li><a href="contact.php" class="nav-link px-2 text-dark">Nous contacter</a></li>
                <?php else:?>
                  <li><a href="contact.php" class="nav-link px-2 text-light">Nous contacter</a></li>
                <?php endif;?>

                <?php if(($_SERVER['PHP_SELF']) == "/views/panier.php"):?>
                  <?php if(!empty($_SESSION["cart"])):?>
                    <li><a href="panier.php" class="nav-link px-2 text-blue">Panier</a></li>
                  <?php else:?>
                    <li><a href="panier.php" class="nav-link px-2 text-dark">Panier</a></li>
                  <?php endif;?>
                <?php else:?>
                  <?php if(!empty($_SESSION["cart"])):?>
                    <li><a href="panier.php" class="nav-link px-2 text-blue">Panier</a></li>
                  <?php else:?>
                    <li><a href="panier.php" class="nav-link px-2 text-light">Panier</a></li>
                  <?php endif;?>
                <?php endif;?>

              </ul>

              <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="searching.php" method="GET">
                <input type="search" class="form-control form-control-#6D8BB0 text-bg-light" name="q" placeholder="Rechercher..." aria-label="Search">
              </form>

              <div class="text-end">
              <?php if(!isset($_SESSION["users"])):?>
                <button type="button" class="btn left me-2"><a href="login.php">Se connecter</a></button>
                <button type="button" class="btn btn-warning"><a href="register.php">Créer un compte</a></button>
              <?php else:?>
                  <button type="button" class="btn left me-2"><a href="compte.php">Mon compte</a></button>
                  <button type="button" class="btn btn-warning"><a href="logout.php">Déconnexion</a></button>
              <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </main>
      <script src="boostrap/assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>