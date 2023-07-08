<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "views\database.php";
    $id = $_GET["id"];

    $conn->query("DELETE FROM users WHERE user_id = $id");
    header("Location: backoffice\users.php");
    exit();
?>