<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si l'image 1 est envoyée
    if (isset($_FILES['image1']['name']) && !empty($_FILES['image1']['name'])) {
        // Récupérer le nom temporaire du fichier image
        $tmpImage1 = $_FILES["image1"]["tmp_name"];

        // Définir l'emplacement et le nom du fichier final de l'image
        $location = "https://mjfilrouge.azurewebsites.net/views/images/carousel/";
        $image1 = $location . basename($_FILES["image1"]["name"]);

        // Vérifier le format d'image autorisé
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        $image1FileType = strtolower(pathinfo($_FILES["image1"]["name"], PATHINFO_EXTENSION));

        if (in_array($image1FileType, $allowedFormats)) {
            // Déplacer l'image téléchargée vers le dossier approprié
            $targetDir = "../images/carousel/";
            // Créer le dossier s'il n'existe pas
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetFile1 = $targetDir . basename($_FILES["image1"]["name"]);

            // Déplacer l'image téléchargée vers le dossier cible
            move_uploaded_file($tmpImage1, $targetFile1);

            // Mettre à jour le nom de l'image dans la base de données
            $sql = "UPDATE carousel SET image1 = ?";
            $params = array($image1);

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                echo "L'image 1 du carrousel a été mise à jour avec succès.";
            } catch (PDOException $e) {
                // Afficher l'erreur SQL
                echo "Erreur SQL : " . $e->getMessage() . "<br>";
                echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
                echo "Informations complémentaires : ";
                print_r($stmt->errorInfo());
                die();
            }
        } else {
            echo "Format d'image autorisé : JPG, JPEG, PNG, GIF uniquement pour l'image 1.";
        }
    }

    // Vérifier si l'image 2 est envoyée
    if (isset($_FILES['image2']['name']) && !empty($_FILES['image2']['name'])) {
        // Récupérer le nom temporaire du fichier image
        $tmpImage2 = $_FILES["image2"]["tmp_name"];

        // Définir l'emplacement et le nom du fichier final de l'image
        $location = "https://mjfilrouge.azurewebsites.net/views/images/carousel/";
        $image2 = $location . basename($_FILES["image2"]["name"]);

        // Vérifier le format d'image autorisé
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        $image2FileType = strtolower(pathinfo($_FILES["image2"]["name"], PATHINFO_EXTENSION));

        if (in_array($image2FileType, $allowedFormats)) {
            // Déplacer l'image téléchargée vers le dossier approprié
            $targetDir = "../images/carousel/";
            // Créer le dossier s'il n'existe pas
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetFile2 = $targetDir . basename($_FILES["image2"]["name"]);

            // Déplacer l'image téléchargée vers le dossier cible
            move_uploaded_file($tmpImage2, $targetFile2);

            // Mettre à jour le nom de l'image dans la base de données
            $sql = "UPDATE carousel SET image2 = ?";
            $params = array($image2);

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                echo "L'image 2 du carrousel a été mise à jour avec succès.";
            } catch (PDOException $e) {
                // Afficher l'erreur SQL
                echo "Erreur SQL : " . $e->getMessage() . "<br>";
                echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
                echo "Informations complémentaires : ";
                print_r($stmt->errorInfo());
                die();
            }
        } else {
            echo "Format d'image autorisé : JPG, JPEG, PNG, GIF uniquement pour l'image 2.";
        }
    }

    // Vérifier si l'image 3 est envoyée
    if (isset($_FILES['image3']['name']) && !empty($_FILES['image3']['name'])) {
        // Récupérer le nom temporaire du fichier image
        $tmpImage3 = $_FILES["image3"]["tmp_name"];

        // Définir l'emplacement et le nom du fichier final de l'image
        $location = "https://mjfilrouge.azurewebsites.net/views/images/carousel/";
        $image3 = $location . basename($_FILES["image3"]["name"]);

        // Vérifier le format d'image autorisé
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        $image3FileType = strtolower(pathinfo($_FILES["image3"]["name"], PATHINFO_EXTENSION));

        if (in_array($image3FileType, $allowedFormats)) {
            // Déplacer l'image téléchargée vers le dossier approprié
            $targetDir = "../images/carousel/";
            // Créer le dossier s'il n'existe pas
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetFile3 = $targetDir . basename($_FILES["image3"]["name"]);

            // Déplacer l'image téléchargée vers le dossier cible
            move_uploaded_file($tmpImage3, $targetFile3);

            // Mettre à jour le nom de l'image dans la base de données
            $sql = "UPDATE carousel SET image3 = ?";
            $params = array($image3);

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                echo "L'image 3 du carrousel a été mise à jour avec succès.";
            } catch (PDOException $e) {
                // Afficher l'erreur SQL
                echo "Erreur SQL : " . $e->getMessage() . "<br>";
                echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
                echo "Informations complémentaires : ";
                print_r($stmt->errorInfo());
                die();
            }
        } else {
            echo "Format d'image autorisé : JPG, JPEG, PNG, GIF uniquement pour l'image 3.";
        }
    }
}

if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/category.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
        <link href="../boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="carousel-images">
            <?php
            // Récupérer les images du carrousel depuis la base de données
            $stmt = $conn->query("SELECT image1, image2, image3 FROM carousel");
            $row = $stmt->fetch();

            // Vérifier si les images existent dans la base de données
            if ($row) {
                $image1 = $row['image1'];
                $image2 = $row['image2'];
                $image3 = $row['image3'];

                // Afficher les images du carrousel avec le code HTML
                echo '<img src="' . $image1 . '" alt="Image 1">';
                echo '<img src="' . $image2 . '" alt="Image 2">';
                echo '<img src="' . $image3 . '" alt="Image 3">';
            } else {
                echo "Aucune image trouvée dans le carrousel.";
            }
            ?>
        </div>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <label for="image1">Image 1</label>
            <input type="file" id="image1" name="image1">

            <label for="image2">Image 2</label>
            <input type="file" id="image2" name="image2">

            <label for="image3">Image 3</label>
            <input type="file" id="image3" name="image3">

            <input type="submit" class="change-images-button" value="Changer les images">
        </form>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
