<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../compte.php');
    exit();
  }

require_once "header.php";
require_once "../database.php";
// Récupérer les catégories depuis la table "categorie"
$sqlCategories = "SELECT * FROM categories";
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
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/createproduct.css">
    <script>
        function copyAddress() {
            if (document.getElementById('same_address_checkbox').checked) {
                document.getElementById('billing_address').value = document.getElementById('shipping_address').value;
            } else {
                document.getElementById('billing_address').value = '';
            }
        }
    </script>
    </head>
    <body>
        <div class="createproduct">
            <h1 class="titleCreateProduct">Créer produit</h1>
            <form action="../products.php" method="post">
            <div class="form-row inline-labels">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
            </div>
            <label for="materials">Matériaux :</label>
                <select name="materials" id="materials">
                    <option value="">Sélecionner un matériau</option>
                    <?php foreach ($materials as $material): ?>
                        <option value="<?php echo $material; ?>"><?php echo $material; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label for="quantity">Quantité :</label>
            <input type="quantity" id="quantity" name="quantity" required>

            <label for="price">Prix :</label>
            <input type="price" id="price" name="price" required>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" required>
            
            <label for="categories">Catégorie :</label>
                <select name="categories" id="categories">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <input type="submit" value="Créer produit">
        </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>