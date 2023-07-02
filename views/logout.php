<?php
    session_start();
    unset($_SESSION['users']);

    // Redirige vers la page de connexion
    header('Location: login.php');
    exit();
?>
