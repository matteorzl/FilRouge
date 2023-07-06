<?php
    session_start();
    require_once "database.php";

    if(!isset($_SESSION["panier"])){
        $_SESSION["panier"] = array();
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $stmt = $conn->query("SELECT * FROM products WHERE product_id = $id");
        $product = $stmt->fetch();

        if(empty($stmt)){
            echo "<script>alert(\"Ce produit n'existe pas\")</script>";
        }

        if(isset($_SESSION["panier"][$id])){
            $_SESSION["panier"][$id]++;
        }else{
            $_SESSION["panier"][$id]= 1;    
        }

        header('Location: liste-produits.php');
        
    }

?>