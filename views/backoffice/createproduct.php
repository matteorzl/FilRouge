<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$sqlMaterials = "SELECT * FROM materials";
$stmtMaterials = $conn->query($sqlMaterials);
$materials = $stmtMaterials->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $location = "https://mjfilrouge.azurewebsites.net/views/images/product/";
    $image1 = $location . $_FILES["image1"]["name"]; // Nom du fichier de l'image 1
    $image2 = $location . $_FILES["image2"]["name"]; // Nom du fichier de l'image 2
    $image3 = $location . $_FILES["image3"]["name"]; // Nom du fichier de l'image 3
    $material_id = $_POST["materials"];
    $category_id = $_POST["categories"];

    // Valider et filtrer les données

    // Insérer les données dans la table "products"
    $sql = "INSERT INTO products ([category_id], [material_id], [name], [description], [image1], [image2] , [image3], [quantity], [price]) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id, $material_id, $name, $description, $image1, $image2, $image3, $quantity, $price]);

    // Déplacer le fichier de l'image vers un dossier spécifié

    $targetDir = "../images/product/"; // Chemin du dossier de destination des images
    // Créer le dossier s'il n'existe pas
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
       
    $targetFile1 = $targetDir . basename($_FILES["image1"]["name"]);
    $targetFile2 = $targetDir . basename($_FILES["image2"]["name"]);
    $targetFile3 = $targetDir . basename($_FILES["image3"]["name"]);

    move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFile1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFile2);
    move_uploaded_file($_FILES["image3"]["tmp_name"], $targetFile3);

    $thumbnailPath1 = $targetDir . "thumbnail_" . $_FILES["image1"]["name"];
    $thumbnailPath2 = $targetDir . "thumbnail_" . $_FILES["image2"]["name"];
    $thumbnailPath3 = $targetDir . "thumbnail_" . $_FILES["image3"]["name"];

    $thumbnail = imagecreatetruecolor(150, 150);

    $sourceImage1 = imagecreatefromjpeg($targetFile1);
    $sourceImage2 = imagecreatefromjpeg($targetFile2);
    $sourceImage3 = imagecreatefromjpeg($targetFile3);

    $sourceWidth1 = imagesx($sourceImage1);
    $sourceWidth2 = imagesx($sourceImage2);
    $sourceWidth3 = imagesx($sourceImage3);

    $sourceHeight1 = imagesy($sourceImage1);
    $sourceHeight2 = imagesy($sourceImage2);
    $sourceHeight3 = imagesy($sourceImage3);

    imagecopyresampled($thumbnail, $sourceImage1, 0, 0, 0, 0, 150, 150, $sourceWidth1, $sourceHeight1);
    imagecopyresampled($thumbnail, $sourceImage2, 0, 0, 0, 0, 150, 150, $sourceWidth2, $sourceHeight2);
    imagecopyresampled($thumbnail, $sourceImage3, 0, 0, 0, 0, 150, 150, $sourceWidth3, $sourceHeight3);

    imagejpeg($thumbnail, $thumbnailPath1);
    imagejpeg($thumbnail, $thumbnailPath2);
    imagejpeg($thumbnail, $thumbnailPath3);

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

        <label for="quantity">Quantité</label>
        <input type="text" id="quantity" name="quantity" required>

        <label for="price">Prix</label>
        <input type="text" id="price" name="price" required>

        <label for="image">1er Image </label>
        <input type="file" id="image1" name="image1" required>

        <label for="image">2ème Image</label>
        <input type="file" id="image2" name="image2" required>

        <label for="image">3ème Image</label>
        <input type="file" id="image3" name="image3" required>

        <label for="materials">Matériau</label>
        <select name="materials" id="materials">
            <option value="">Sélectionner un matériau</option>
            <?php foreach ($materials as $material): ?>
                <option value="<?php echo $material['material_id']; ?>"><?php echo $material['name']; ?></option>
            <?php endforeach; ?>
        </select>

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
