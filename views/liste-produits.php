<!--Test-->
<?php
    session_start();
    require_once "header.php";
    require_once "database.php";

    // Récupérer les catégories depuis la table "categorie"
    $sqlCategories = "SELECT * FROM categorie";
    $stmtCategories = $conn->query($sqlCategories);
    $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les matériaux distincts depuis la colonne "material" de la table "products"
    $sqlMaterials = "SELECT DISTINCT material FROM products";
    $stmtMaterials = $conn->query($sqlMaterials);
    $materials = $stmtMaterials->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/liste-produits.css">
        <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <aside>
            <div class="aside_category">
                <h3>Filtres :</h3>
                <form method="get" action="">
                    <label for="category">Catégorie :</label>
                    <select name="category" id="category">
                        <option value="">Toutes les catégories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="materials">Matériaux :</label>
                    <select name="materials" id="materials">
                        <option value="">Tous les matériaux</option>
                        <?php foreach ($materials as $material): ?>
                            <option value="<?php echo $material; ?>"><?php echo $material; ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button type="submit">Filtrer</button>
                </form>
            </div>
        </aside>
        <?php
            // Récupérer les paramètres de filtrage
            $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
            $materialFilter = isset($_GET['materials']) ? $_GET['materials'] : '';

            // Préparer la requête SQL
            $sqlProducts = "SELECT p.*, i.bin FROM products p
               INNER JOIN images i ON p.image_id = i.image_id
               WHERE 1=1";
            if (!empty($categoryFilter)) {
                $sqlProducts .= " AND category_id = :category";
            }
            if (!empty($materialFilter)) {
                $sqlProducts .= " AND material = :material";
            }

            // Préparer les paramètres pour la requête préparée
            $params = [];
            if (!empty($categoryFilter)) {
                $params['category'] = $categoryFilter;
            }
            if (!empty($materialFilter)) {
                $params['material'] = $materialFilter;
            }

            // Exécuter la requête avec les paramètres de filtrage
            $stmtProducts = $conn->prepare($sqlProducts);
            $stmtProducts->execute($params);
            $products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $row) {?>
            <form method="post" action="produit.php?id=<?=$row['product_id']?>" class="form_list_prod">
                <button type="submit" class="button_liste">
                    <div class="produit_img">
                        <img src="<?php echo $rowImg['bin']; ?>" width="150" class="img_produit">
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
    <?php 
        }
    ?>

    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>