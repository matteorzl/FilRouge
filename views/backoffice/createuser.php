<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
  }

  require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["lastname"], $_POST["firstname"], $_POST["mail"], $_POST["pwd"], $_POST["role"])
     && !empty($_POST["lastname"])&& !empty($_POST["firstname"])&& !empty($_POST["mail"])&& !empty($_POST["pwd"])&& !empty($_POST["role"])){
    
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $mail = $_POST["mail"];
        $pwd = $_POST["pwd"];
        $role = $_POST["role"];

        //On verifie si un compte existe deja 
        $sql = "SELECT * FROM users WHERE mail = ?";
        $params = array($mail);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            // L'adresse e-mail existe déjà
            $_SESSION['error_message'] = "Cette adresse mail est déjà utilisée";
            header('Location: backoffice/users.php');
            }else{


            // Hash du mot de passe
            $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (lastname, firstname, mail, pwd, [role]) VALUES (?, ?, ?, ?, ?)";
            $params = array($lastname, $firstname, $mail, $hashedpwd, $role);
            
            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                $user_id = $conn->lastInsertId();
                exit();
            } catch (PDOException $e) {
                die("Erreur lors de l'inscription : " . $e->getMessage());
            }
        }
    }
    else {
        echo "<script>alert(\"Toutes les informations de sont pas remplis\")</script>";
    }
}

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
            <h1 class="titleCreateUser">Créer Utilisateur</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required>
                
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required>
                
                <label for="mail">Email</label>
                <input type="mail" id="mail" name="mail" required>

                <label for="pwd">Mot de passe</label>
                <input type="password" id="pwd" name="pwd" required>
                

                <label for="role">Rôle</label>
                    <select name="role" id="role">
                        <option value="0">Utilisateur</option>
                        <option value="1">Administrateur</option>
                    </select>
                </label>
                <input type="submit" class="createbutton" value="Créer utilisateur">
            </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>