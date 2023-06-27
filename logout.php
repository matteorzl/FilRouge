<?php
    session_start();
    unset($_SESSION['username']);

    // Redirige vers la page de connexion
    header('Location: login.php');
    exit();
?>
