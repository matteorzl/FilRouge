<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once "database.php";

    // Récupérer les catégories depuis la table "categorie"
    $sqlCategories = "SELECT * FROM categories";
    $stmtCategories = $conn->query($sqlCategories);
    $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les matériaux distincts depuis la colonne "material" de la table "products"
    $sqlMaterials = "SELECT DISTINCT material FROM products";
    $stmtMaterials = $conn->query($sqlMaterials);
    $materials = $stmtMaterials->fetchAll(PDO::FETCH_COLUMN);

    require_once "header.php";
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
                    <form method="get" action="" class="aside_category_form">
                    <div class="category_div">
                        <label for="category">Catégorie :</label>
                        <select name="category" id="category">
                            <option value="">Toutes les catégories</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="material_div">
                        <label for="materials">Matériaux :</label>
                        <select name="materials" id="materials">
                            <option value="">Tous les matériaux</option>
                            <?php foreach ($materials as $material): ?>
                                <option value="<?php echo $material; ?>"><?php echo $material; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="price_div">
                        <label for="min_price">Prix min :</label>
                        <input type="number" name="min_price" id="min_price" value="<?php echo $minPrice; ?>">
                        <label for="max_price">Prix max :</label>
                        <input type="number" name="max_price" id="max_price" value="<?php echo $maxPrice; ?>">
                    </div>
                    <button type="submit">Filtrer</button>
                </form>
            </div>
        </aside>

        <?php
            // Récupérer les paramètres de filtrage
            $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
            $materialFilter = isset($_GET['materials']) ? $_GET['materials'] : '';
            $minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : '';
            $maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : '';

            // Préparer la requête SQL
            $sqlProducts = "SELECT p.* FROM products p WHERE 1=1"; // Condition de départ

            if (!empty($categoryFilter)) {
                $sqlProducts .= " AND category_id = :category";
            }
            if (!empty($materialFilter)) {
                $sqlProducts .= " AND material = :material";
            }
            if (!empty($minPrice)) {
                $sqlProducts .= " AND price >= :min_price";
            }
            if (!empty($maxPrice)) {
                $sqlProducts .= " AND price <= :max_price";
            }

            // Préparer les paramètres pour la requête préparée
            $params = [];
            if (!empty($categoryFilter)) {
                $params['category'] = $categoryFilter;
            }
            if (!empty($materialFilter)) {
                $params['material'] = $materialFilter;
            }
            if (!empty($minPrice)) {
                $params['min_price'] = $minPrice;
            }
            if (!empty($maxPrice)) {
                $params['max_price'] = $maxPrice;
            }

            // Exécuter la requête avec les paramètres de filtrage
            $stmtProducts = $conn->prepare($sqlProducts);
            $stmtProducts->execute($params);
            $products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $row) {?>
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
    <?php 
        }
    ?>

    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>