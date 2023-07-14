<?php
    session_start();
    require_once "../database.php";
?>
<!doctype html>
<html lang="fr" dir="ltr">
  <head><script src="../boostrap/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BACKOFFICE - AIRNEIS</title>

    <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo/icon.ico" />
  </head>
  <body>
      <main>
        <div class="header">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
              <img src="..\images\logo\logo.png" width="80px" height="60px" margin-right="15px">

              <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/dashboard.php"):?>
                  <li><a href="dashboard.php" class="nav-link px-2 text-dark">Accueil</a></li>
                <?php else:?>
                  <li><a href="dashboard.php" class="nav-link px-2 text-light">Accueil</a></li>
                <?php endif;?>
                
                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/category.php"):?>
                  <li><a href="category.php" class="nav-link px-2 text-dark">Catégorie</a></li>
                <?php else:?>
                  <li><a href="category.php" class="nav-link px-2 text-light">Catégorie</a></li>
                <?php endif;?>

                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/material.php"):?>
                  <li><a href="material.php" class="nav-link px-2 text-dark">Matériau</a></li>
                <?php else:?>
                  <li><a href="material.php" class="nav-link px-2 text-light">Matériau</a></li>
                <?php endif;?>
                
                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/products.php"):?>
                  <li><a href="products.php" class="nav-link px-2 text-dark">Produits</a></li>
                <?php else:?>
                  <li><a href="products.php" class="nav-link px-2 text-light">Produits</a></li>
                <?php endif;?>

                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/carousel.php"):?>
                  <li><a href="carousel.php" class="nav-link px-2 text-dark">Carrousel</a></li>
                <?php else:?>
                  <li><a href="carousel.php" class="nav-link px-2 text-light">Carrousel</a></li>
                <?php endif;?>

                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/contacts.php"):?>
                  <li><a href="contacts.php" class="nav-link px-2 text-dark">Contacts</a></li>
                <?php else:?>
                  <li><a href="contacts.php" class="nav-link px-2 text-light">Contacts</a></li>
                <?php endif;?>

                <?php if(($_SERVER['PHP_SELF']) == "/views/backoffice/users.php"):?>
                  <li><a href="users.php" class="nav-link px-2 text-dark">Utilisateur</a></li>
                <?php else:?>
                  <li><a href="users.php" class="nav-link px-2 text-light">Utilisateur</a></li>
                <?php endif;?>
              </ul>
              <div class="text-end">
              <?php if(!isset($_SESSION["users"])):?>
                <button type="button" class="btn left me-2"><a href="login.php">Se connecter</a></button>
                <button type="button" class="btn btn-warning"><a href="register.php">Créer un compte</a></button>
              <?php else:?>
                  <button type="button" class="btn btn-warning"><a href="logout.php">Déconnexion</a></button>
              <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </main>
      <script src="../boostrap/assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
