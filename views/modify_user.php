<?php
    session_start();
    require_once "database.php";
    $user_id = $_GET["id"];

    if($_SESSION["users"]["user_id"] !== $user_id){
        header('Location: compte.php');
    }
    require_once "header.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Modifiez vos informations</title>
        <link rel="stylesheet" href="css/modify_user.css">
    <head>
    <body>
        <?php
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $mail = $_POST['mail'];
            $pwd = $_POST['pwd'];

            $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

            // Construire la requête de mise à jour en fonction des champs renseignés
            $update_query = "UPDATE users SET ";

            if (!empty($lastname)) {
                $update_query .= "lastname='$lastname', ";
            }

            if (!empty($firstname)) {
                $update_query .= "firstname='$firstname', ";
            }

            if (!empty($mail)) {
                $update_query .= "mail='$mail', ";
            }

            if (!empty($pwd)) {
                $update_query .= "pwd='$hashed_pwd', ";
            }

            // Supprimer la virgule et l'espace en trop à la fin de la requête
            $update_query = rtrim($update_query, ", ");

            // Ajouter la clause WHERE pour mettre à jour l'utilisateur spécifique
            $update_query .= " WHERE user_id='$user_id'";

            // Exécuter la requête de mise à jour
            if ($conn->query($update_query) === TRUE) {
                echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des informations de l'utilisateur: " . $conn->error;
            }

            $conn->close();
        }
        ?>
        <div class="modify_user">
            <h2>Modifiez vos informations</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname"><br><br>

                <label for="firstname">Prénom :</label>
                <input type="text" name="firstname"><br><br>

                <label for="mail">E-mail :</label>
                <input type="email" name="mail"><br><br>

                <label for="pwd">Mot de passe :</label>
                <input type="password" name="pwd"><br><br>

                <input type="submit" value="Enregistrer les modifications">
            </form>
        </div>
    </body>
</html>
