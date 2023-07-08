<?php 
    require_once "../database.php";
    $id = $_GET["id"];

    $conn->query("DELETE FROM users WHERE user_id = $id");
    header("Location: backoffice/users.php")
?>