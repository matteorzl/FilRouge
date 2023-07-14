<?php
    // Début de la session
    session_start();
    // Inclusion du fichier de base de données
    require_once "database.php";

    // Vérification si le panier n'est pas encore défini dans la session
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }

    // Vérification si l'identifiant du produit est présent dans les paramètres GET
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        // Requête pour récupérer les informations du produit correspondant à l'identifiant
        $stmt = $conn->query("SELECT * FROM products WHERE product_id = $id");
        $product = $stmt->fetch();

        // Vérification si le produit existe
        if(empty($product)){
            echo "<script>alert(\"Ce produit n'existe pas\")</script>";
        }

        // Ajout du produit au panier
        if(isset($_SESSION["cart"][$id])){
            $_SESSION["cart"][$id]++;
        }else{
            $_SESSION["cart"][$id] = 1;    
        }

        // Redirection vers la page "liste-produits.php"
        header('Location: liste-produits.php');
        
    }

?>
