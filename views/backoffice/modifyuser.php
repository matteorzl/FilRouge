<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
}

require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user_id"], $_POST["lastname"], $_POST["firstname"], $_POST["mail"], $_POST["pwd"], $_POST["role"])
     && !empty($_POST["user_id"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["mail"]) && !empty($_POST["pwd"]) && !empty($_POST["role"])) {
        
        $user_id = $_POST["user_id"];
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $mail = $_POST["mail"];
        $pwd = $_POST["pwd"];
        $role = $_POST["role"];
        
        // On vérifie si un compte existe déjà avec l'adresse e-mail fournie (autre que l'utilisateur en cours de modification)
        $sql = "SELECT COUNT(*) FROM users WHERE mail = ? AND user_id != ?";
        $params = array($mail, $user_id);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            // L'adresse e-mail existe déjà pour un autre utilisateur
            $_SESSION['error_message'] = "Cette adresse e-mail est déjà utilisée";
            header('Location: users.php');
            exit();
        }
        
        // Hash du mot de passe
        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);
        
        $sql = "UPDATE users SET lastname = ?, firstname = ?, mail = ?, pwd = ?, role = ? WHERE user_id = ?";
        $params = array($lastname, $firstname, $mail, $hashedpwd, $role, $user_id);
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            header('Location: users.php');
            exit();
        } catch (PDOException $e) {
            die("Erreur lors de la modification de l'utilisateur : " . $e->getMessage());
        }
    } else {
        echo "<script>alert(\"Toutes les informations ne sont pas remplies\")</script>";
    }
}

require_once "header.php";

// Vérifier si un ID d'utilisateur est passé en paramètre
if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
    
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $params = array($user_id);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $user = $stmt->fetch();
} else {
    // Rediriger vers la liste des utilisateurs si aucun ID n'est spécifié
    header('Location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/modifyuser.css">
</head>
<body>
    <div class="modifyuser">
        <h1 class="titleModifyUser">Modifier Utilisateur</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
            
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
            
            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail" value="<?php echo $user['mail']; ?>" required>
            
            <label for="pwd">Mot de passe</label>
            <input type="password" id="pwd" name="pwd" required>
            
            <label for="role">Rôle</label>
            <select name="role" id="role">
                <option value="0" <?php if ($user['role'] == 0) echo 'selected'; ?>>Utilisateur</option>
                <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Administrateur</option>
            </select>
            
            <input type="submit" class="modifybutton" value="Modifier utilisateur">
        </form>
   </div>
</body>
<footer>
    <?php require "footer.php" ?>
</footer>
</html>
