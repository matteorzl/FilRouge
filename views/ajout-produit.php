<?php
    session_start();
    require_once "database.php";

    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $stmt = $conn->query("SELECT * FROM products WHERE product_id = $id");
        $product = $stmt->fetch();

        if(empty($stmt)){
            echo "<script>alert(\"Ce produit n'existe pas\")</script>";
        }

        if(isset($_SESSION["cart"][$id])){
            $_SESSION["cart"][$id]++;
        }else{
            $_SESSION["cart"][$id]= 1;    
        }

        header('Location: liste-produits.php');
        
    }

?>