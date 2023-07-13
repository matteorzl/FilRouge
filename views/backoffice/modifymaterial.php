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
    if (isset($_POST['name']) && $_POST['name'] != "") {
        // Récupérer les valeurs du formulaire
        $material_id = $_POST["material_id"];
        $name = $_POST["name"];

        // Mettre à jour le nom dans la base de données
        $sql = "UPDATE materials SET name = ? WHERE material_id = ?";
        $params = array($name, $material_id);

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            header('Location: material.php');
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
        $message = "Veuillez remplir tous les champs.";
    }
}

// Récupérer l'ID du matériau à modifier
if (isset($_GET['id'])) {
    $material_id = $_GET['id'];
    
    // Récupérer les informations du matériau depuis la base de données
    $sql = "SELECT * FROM materials WHERE material_id = ?";
    $params = array($material_id);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $material = $stmt->fetch(PDO::FETCH_ASSOC);
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
            <h1 class="titleModifyCategory">Modifier Matériau</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="material_id" value="<?php echo $material['material_id']; ?>">

                <label for="name">Nom</label>
                <input type="text" id="name" name="name" value="<?php echo $material['name']; ?>" required>

                <input type="submit" class="modifybutton" value="Modifier Matériau">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>
