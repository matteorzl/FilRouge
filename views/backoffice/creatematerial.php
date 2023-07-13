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
        $name = $_POST["name"];

        // Insérer le nom dans la base de données
        $sql = "INSERT INTO materials ([name]) VALUES (?)";
        $params = array($name);

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
        $message = "Veuillez remplir tous les champs.";
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
            <h1 class="titleCreateCategory">Créer Matériau</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>

                <input type="submit" class="createbutton" value="Créer Matériau">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>