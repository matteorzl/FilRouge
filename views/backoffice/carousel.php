<?php
// Vérifier si les images sont envoyées
if (
    !empty($_FILES['image1']['name']) &&
    !empty($_FILES['image2']['name']) &&
    !empty($_FILES['image3']['name'])
) {
    // Récupérer les noms temporaires des fichiers images
    $tmpImage1 = $_FILES["image1"]["tmp_name"];
    $tmpImage2 = $_FILES["image2"]["tmp_name"];
    $tmpImage3 = $_FILES["image3"]["tmp_name"];

    // Définir les emplacements et les noms de fichiers finaux des images
    $location = "https://mjfilrouge.azurewebsites.net/views/images/carousel/";
    $image1 = $location . basename($_FILES["image1"]["name"]);
    $image2 = $location . basename($_FILES["image2"]["name"]);
    $image3 = $location . basename($_FILES["image3"]["name"]);

    // Vérifier les formats d'image autorisés
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    $image1FileType = strtolower(pathinfo($tmpImage1, PATHINFO_EXTENSION));
    $image2FileType = strtolower(pathinfo($tmpImage2, PATHINFO_EXTENSION));
    $image3FileType = strtolower(pathinfo($tmpImage3, PATHINFO_EXTENSION));

    if (
        in_array($image1FileType, $allowedFormats) &&
        in_array($image2FileType, $allowedFormats) &&
        in_array($image3FileType, $allowedFormats)
    ) {
        // Déplacer les images téléchargées vers le dossier approprié
        $targetDir = "../images/carousel/";
        // Créer le dossier s'il n'existe pas
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $targetFile1 = $targetDir . basename($_FILES["image1"]["name"]);
        $targetFile2 = $targetDir . basename($_FILES["image2"]["name"]);
        $targetFile3 = $targetDir . basename($_FILES["image3"]["name"]);

        // Déplacer les images téléchargées vers le dossier cible
        move_uploaded_file($tmpImage1, $targetFile1);
        move_uploaded_file($tmpImage2, $targetFile2);
        move_uploaded_file($tmpImage3, $targetFile3);

        // Insérer les noms des images dans la base de données
        $sql = "UPDATE carousel SET image1 = ?, image2 = ?, image3 = ?";
        $params = array($image1, $image2, $image3);

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            echo "Les images du carrousel ont été insérées avec succès.";
        } catch (PDOException $e) {
            // Afficher l'erreur SQL
            echo "Erreur SQL : " . $e->getMessage() . "<br>";
            echo "Code d'erreur SQL : " . $e->getCode() . "<br>";
            echo "Informations complémentaires : ";
            print_r($stmt->errorInfo());
            die();
        }
    } else {
        echo "Formats d'image autorisés : JPG, JPEG, PNG, GIF uniquement.";
    }
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
        <img src="<?php echo $image1; ?>" alt="Image 1">
        <img src="<?php echo $image2; ?>" alt="Image 2">
        <img src="<?php echo $image3; ?>" alt="Image 3">
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
