<?php
session_start();
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

require_once "../database.php";

$id = $_GET["id"]; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["lastname"], $_POST["firstname"], $_POST["mail"], $_POST["role"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["mail"]) && !empty($_POST["role"])) {
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $mail = $_POST["mail"];
        $role = $_POST["role"];

        // Vérifier si l'adresse e-mail existe déjà pour un autre utilisateur
        $sqlCheckEmail = "SELECT user_id FROM users WHERE mail = :mail AND user_id != :id";
        $stmtCheckEmail = $conn->prepare($sqlCheckEmail);
        $stmtCheckEmail->bindParam(":mail", $mail);
        $stmtCheckEmail->bindParam(":id", $id);
        $stmtCheckEmail->execute();

        if ($stmtCheckEmail->rowCount() > 0) {
            $_SESSION["error_message"] = "Cette adresse mail est déjà utilisée par un autre utilisateur";
            header("Location: modifyuser.php?id=$id");
            exit();
        }

        // Mettre à jour les informations de l'utilisateur
        $sqlUpdateUser = "UPDATE users SET lastname = :lastname, firstname = :firstname, mail = :mail, [role] = :[role] WHERE user_id = :id";
        $stmtUpdateUser = $conn->prepare($sqlUpdateUser);
        $stmtUpdateUser->bindParam(":lastname", $lastname);
        $stmtUpdateUser->bindParam(":firstname", $firstname);
        $stmtUpdateUser->bindParam(":mail", $mail);
        $stmtUpdateUser->bindParam(":role", $role);
        $stmtUpdateUser->bindParam(":id", $id);

        if ($stmtUpdateUser->execute()) {
            $_SESSION["success_message"] = "Utilisateur mis à jour avec succès";
            header("Location: users.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Une erreur s'est produite lors de la mise à jour de l'utilisateur";
            header("Location: modifyuser.php?id=$id");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Toutes les informations ne sont pas remplies";
        header("Location: modifyuser.php?id=$id");
        exit();
    }
}

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch();

require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/createuser.css">
</head>
<body>
    <div class="createuser">
        <h1 class="titleCreateUser">Modifier Utilisateur</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$id"; ?>">
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" required value="<?php echo $user['lastname']; ?>">

            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required value="<?php echo $user['firstname']; ?>">

            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail" required value="<?php echo $user['mail']; ?>">

            <label for="role">Rôle</label>
            <select name="role" id="role">
                <option value="0" <?php if ($user['role'] == 0) echo "selected"; ?>>Utilisateur</option>
                <option value="1" <?php if ($user['role'] == 1) echo "selected"; ?>>Administrateur</option>
            </select>

            <input type="submit" class="createbutton" value="Modifier utilisateur">
        </form>
   </div>
</body>
<footer>
    <?php require "footer.php"; ?>
</footer>
</html>
