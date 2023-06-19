<?php
    session_start();

    // Détruit toutes les variables de session
    session_destroy();

    // Redirige vers la page de connexion
    header('Location: login.php');
    exit();
?>
