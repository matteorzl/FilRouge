<?php
    session_start();
    if(!isset($_SESSION["users"])){
        header('Location: login.php');
        exit();
      }
    unset($_SESSION['users']);

    // Redirige vers la page de connexion
    header('Location: login.php');
    exit();
?>
