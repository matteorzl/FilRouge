<?php
session_start();
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

require_once "../database.php";

// Récupérer les catégories depuis la table "categories"
$sqlCategories = "SELECT * FROM categories";
$stmtCategories = $conn->query($sqlCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les matériaux distincts depuis la colonne "material" de la table "products"
$sqlMaterials = "SELECT DISTINCT material FROM products";
$stmtMaterials = $conn->query($sqlMaterials);
$materials = $stmtMaterials->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $description = $_POST["description"];
    $material = $_POST["materials"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $location = "https://mjfilrouge.azurewebsites.net/views/images/product/";
    $image = $location . $_FILES["image"]["name"]; // Nom du fichier de l'image
    $category_id = $_POST["categories"];

    // Valider et filtrer les données

    // Insérer les données dans la table "products"
    $sql = "INSERT INTO products ([category_id], [name], [description], [material], [image], [quantity], [price]) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id, $name, $description, $material, $image, $quantity, $price]);

    // Déplacer le fichier de l'image vers un dossier spécifié

    $targetDir = "../images/product/"; // Chemin du dossier de destination des images
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

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
    <h1 class="titleCreateProduct">Créer produit</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" required>

        <label for="materials">Matériau</label>
        <select name="materials" id="materials">
            <option value="">Sélectionner un matériau</option>
            <?php foreach ($materials as $material): ?>
                <option value="<?php echo $material; ?>"><?php echo $material; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantité</label>
        <input type="text" id="quantity" name="quantity" required>

        <label for="price">Prix</label>
        <input type="text" id="price" name="price" required>

        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>

        <label for="categories">Catégorie</label>
        <select name="categories" id="categories">
            <option value="">Sélectionner une catégorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" class="createbutton" value="Créer produit">
    </form>
</div>
</body>
<footer>
<?php require "footer.php" ?>
</footer>
</html>
