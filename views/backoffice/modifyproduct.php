<?php
session_start();
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

require_once "../database.php";

// Récupérer l'identifiant du produit à modifier depuis l'URL
if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit();
}

$product_id = $_GET['id'];

// Récupérer les informations du produit à partir de son identifiant
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: products.php');
    exit();
}

// Récupérer les catégories depuis la table "categories"
$sqlCategories = "SELECT * FROM categories";
$stmtCategories = $conn->query($sqlCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les matériaux distincts depuis la colonne "material" de la table "materials"
$sqlMaterials = "SELECT * FROM materials";
$stmtMaterials = $conn->query($sqlMaterials);
$materials = $stmtMaterials->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $material_id = $_POST["materials"];
    $category_id = $_POST["categories"];

    // Valider et filtrer les données

    // Mettre à jour les données du produit dans la table "products"
    $sql = "UPDATE products SET category_id = ?, material_id = ?, name = ?, description = ?, quantity = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id, $material_id, $name, $description, $quantity, $price, $product_id]);

    // Vérifier si de nouvelles images ont été téléchargées
    if ($_FILES["image1"]["name"]) {
        $image1 = "https://mjfilrouge.azurewebsites.net/views/images/product/" . $_FILES["image1"]["name"];
        move_uploaded_file($_FILES["image1"]["tmp_name"], "../images/product/" . $_FILES["image1"]["name"]);
        // Mettre à jour le chemin de l'image 1 dans la table "products"
        $stmt = $conn->prepare("UPDATE products SET image1 = ? WHERE product_id = ?");
        $stmt->execute([$image1, $product_id]);
    }

    if ($_FILES["image2"]["name"]) {
        $image2 = "https://mjfilrouge.azurewebsites.net/views/images/product/" . $_FILES["image2"]["name"];
        move_uploaded_file($_FILES["image2"]["tmp_name"], "../images/product/" . $_FILES["image2"]["name"]);
        // Mettre à jour le chemin de l'image 2 dans la table "products"
        $stmt = $conn->prepare("UPDATE products SET image2 = ? WHERE product_id = ?");
        $stmt->execute([$image2, $product_id]);
    }

    if ($_FILES["image3"]["name"]) {
        $image3 = "https://mjfilrouge.azurewebsites.net/views/images/product/" . $_FILES["image3"]["name"];
        move_uploaded_file($_FILES["image3"]["tmp_name"], "../images/product/" . $_FILES["image3"]["name"]);
        // Mettre à jour le chemin de l'image 3 dans la table "products"
        $stmt = $conn->prepare("UPDATE products SET image3 = ? WHERE product_id = ?");
        $stmt->execute([$image3, $product_id]);
    }

    header('Location: products.php');
    exit();
}

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/createproduct.css">
</head>
<body>
<div class="createproduct">
    <h1 class="titleCreateProduct">Modifier produit</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $product_id; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?php echo $product['description']; ?>" required>

        <label for="quantity">Quantité</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

        <label for="price">Prix</label>
        <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required>

        <label for="image">1ère Image</label>
        <input type="file" id="image1" name="image1">

        <label for="image">2ème Image</label>
        <input type="file" id="image2" name="image2">

        <label for="image">3ème Image</label>
        <input type="file" id="image3" name="image3">

        <label for="materials">Matériau</label>
        <select name="materials" id="materials">
            <option value="">Sélectionner un matériau</option>
            <?php foreach ($materials as $material): ?>
                <option value="<?php echo $material['material_id']; ?>" <?php if ($material['material_id'] == $product['material_id']) echo "selected"; ?>><?php echo $material['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="categories">Catégorie</label>
        <select name="categories" id="categories">
            <option value="">Sélectionner une catégorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>" <?php if ($category['category_id'] == $product['category_id']) echo "selected"; ?>><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" class="createbutton" value="Modifier produit">
    </form>
</div>
</body>
<footer>
<?php require "footer.php" ?>
</footer>
</html>
