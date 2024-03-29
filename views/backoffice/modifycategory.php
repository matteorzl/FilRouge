<?php
session_start();
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

require_once "../database.php";

$stmt = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier que les données sont envoyées
    if (!empty($_FILES['image']['name']) && isset($_POST['name']) && $_POST['name'] != "") {
        // Récupérer les valeurs du formulaire
        $category_id = $_POST["category_id"];
        $name = $_POST["name"];
        $location = "https://mjfilrouge.azurewebsites.net/views/images/category/";
        $image = $location . basename($_FILES["image"]["name"]);

        if (!extension_loaded('gd') || !function_exists('gd_info')) {
            die('L\'extension GD n\'est pas activée. Veuillez vérifier la configuration de votre serveur.');
        } else {
            // Déplacer l'image téléchargée vers le dossier approprié
            $targetDir = "../images/category/";
            // Créer le dossier s'il n'existe pas
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        }

        // Vérifier si le fichier image est réel ou une fausse image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Autoriser certains formats d'image (vous pouvez ajouter d'autres formats si nécessaire)
            $allowedFormats = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $allowedFormats)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // Mettre à jour le nom et l'image dans la base de données
                    $sql = "UPDATE categories SET name = ?, image = ? WHERE category_id = ?";
                    $params = array($name, $image, $category_id);

                    try {
                        $stmt = $conn->prepare($sql);
                        $stmt->execute($params);
                        header('Location: category.php');
                        exit();
                    } catch (PDOException $e) {
                        // Afficher l'erreur SQL
                        echo "Erreur SQL : " . $e->getMessage() . "<br>";
                        echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
                        echo "Informations complémentaires : ";
                        print_r($stmt->errorInfo());
                        die();
                    }
                } else {
                    $message = "Erreur lors du téléchargement de l'image.";
                }
            } else {
                $message = "Formats d'image autorisés : JPG, JPEG, PNG, GIF uniquement.";
            }
        } else {
            $message = "Le fichier sélectionné n'est pas une image valide.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

// Récupérer l'ID de la catégorie à modifier
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Récupérer les informations de la catégorie depuis la base de données
    $sql = "SELECT * FROM categories WHERE category_id = ?";
    $params = array($category_id);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Afficher l'erreur SQL
        echo "Erreur SQL : " . $e->getMessage() . "<br>";
        echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
        echo "Informations complémentaires : ";
        print_r($stmt->errorInfo());
        die();
    }
}

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/modifycategory.css">
    </head>
    <body>
        <div class="modifycategory">
            <h1 class="titleModifyCategory">Modifier Catégorie</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">

                <label for="name">Nom</label>
                <input type="text" id="name" name="name" value="<?php echo $category['name']; ?>" required>

                <label for="image">Image</label>
                <input type="file" id="image" name="image">

                <input type="submit" class="modifybutton" value="Modifier Catégorie">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
