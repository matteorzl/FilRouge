<?php

session_start();
require_once "database.php";
// Récupérer la requête de recherche entrée par l'utilisateur
$searchQuery = $_GET['q'];
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/searching.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php try {

            // Préparer la requête SQL pour rechercher des produits correspondant à la requête de recherche
            $sql = "SELECT * FROM products WHERE name LIKE '%" . $searchQuery . "%'";

            // Exécuter la requête SQL
            $stmt = $conn->query($sql);

            // Traiter les résultats de la recherche
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                // Afficher les résultats
                foreach ($results as $row) { ?>
                    <form method="post" action="produit.php?id=<?=$row['product_id']?>" class="form_list_prod">
                        <button type="submit" class="button_liste">
                            <div class="produit_img">
                                <img src="<?php echo $row['image1']; ?>" width="150" class="img_produit">
                            </div>
                            <div class="info_produit">
                                <h4><?=$row['name']?></h4>
                                <p><?=$row['material']?></p>
                                <p><?=$row['description']?></p>
                            </div>
                            <div class="quantite_prix">
                                <h4><?=$row['price']?>€</h4>
                                <?php if($row['quantity'] > 1): ?>
                                    <p> En stock </p>
                                <?php else: ?>
                                    <p> En rupture </p>
                                <?php endif; ?>
                            </div>
                        </button>
                    </form>
                <?php }
            } else {
                echo "Aucun produit trouvé.";
            }
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        } finally {
            // Fermer la connexion à la base de données
            $conn = null;
        }?>
</body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>