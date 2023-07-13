<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "database.php";

// Vérifier si un identifiant de produit est spécifié dans l'URL
if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit();
}

$product_id = $_GET['id'];

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $material_id = $_POST["materials"];
    $category_id = $_POST["categories"];

    // Mettre à jour les données dans la table "products"
    $sql = "UPDATE products SET category_id = ?, material_id = ?, name = ?, description = ?, quantity = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id, $material_id, $name, $description, $quantity, $price, $product_id]);

    header('Location: products.php');
    exit();
}

// Récupérer les détails du produit à modifier depuis la base de données
$sqlProduct = "SELECT * FROM products WHERE product_id = ?";
$stmtProduct = $conn->prepare($sqlProduct);
$stmtProduct->execute([$product_id]);
$product = $stmtProduct->fetch(PDO::FETCH_ASSOC);

// Récupérer les catégories depuis la table "categories"
$sqlCategories = "SELECT * FROM categories";
$stmtCategories = $conn->query($sqlCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les matériaux depuis la table "materials"
$sqlMaterials = "SELECT * FROM materials";
$stmtMaterials = $conn->query($sqlMaterials);
$materials = $stmtMaterials->fetchAll(PDO::FETCH_ASSOC);

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/modifyproduct.css">
</head>
<body>
<div class="modifyproduct">
    <h1 class="titleModifyProduct">Modifier produit</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $product_id; ?>" method="post">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?php echo $product['description']; ?>" required>

        <label for="quantity">Quantité</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

        <label for="price">Prix</label>
        <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required>

        <label for="materials">Matériau</label>
        <select name="materials" id="materials">
            <option value="">Sélectionner un matériau</option>
            <?php foreach ($materials as $material): ?>
                <option value="<?php echo $material['material_id']; ?>" <?php if ($material['material_id'] == $product['material_id']) echo 'selected'; ?>><?php echo $material['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="categories">Catégorie</label>
        <select name="categories" id="categories">
            <option value="">Sélectionner une catégorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>" <?php if ($category['category_id'] == $product['category_id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" class="modifybutton" value="Modifier produit">
    </form>
</div>
</body>
<footer>
<?php require "footer.php" ?>
</footer>
</html>
