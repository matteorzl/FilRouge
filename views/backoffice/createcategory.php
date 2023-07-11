<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
  }


require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $name = $_POST["name"];
    $image = $_POST["image"];

    $sql = "INSERT INTO categories ([name], [image]) VALUES (?, ?)";
    $params = array($name, $image);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        header('Location: category.php');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la création de la catégorie : " . $e->getMessage());
    }


}

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/createcategory.css">
    </head>
    <body>
        <div class="createcategory">
            <h1 class="titleCreateCategory">Créer Categorie</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>

                <label for="image">Image</label>
                <input type="file" id="image" name="image" required>

                <input type="submit" class="createbutton" value="Créer Catégorie">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
