<?php

session_start();
require_once "database.php";
// Récupérer la requête de recherche entrée par l'utilisateur
$searchQuery = $_GET['q'];

try {

    // Préparer la requête SQL pour rechercher des produits correspondant à la requête de recherche
    $sql = "SELECT * FROM products WHERE name LIKE '%" . $searchQuery . "%'";

    // Exécuter la requête SQL
    $stmt = $conn->query($sql);

    // Traiter les résultats de la recherche
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        // Afficher les résultats
        foreach ($results as $row) {
            echo "Nom du produit : " . $row["name"] . "<br>";
            echo "Description : " . $row["description"] . "<br>";
            echo "Matériau : " . $row["material"] . "<br>";
            echo "Prix : " . $row["price"] . "<br>";
            // Afficher d'autres informations pertinentes sur le produit
        }
    } else {
        echo "Aucun produit trouvé.";
    }
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
} finally {
    // Fermer la connexion à la base de données
    $conn = null;
}

require "footer.php"
?>