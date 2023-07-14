<?php
session_start();

if(isset($_SESSION["users"])){
  header('Location: compte.php');
  exit();
}

require_once "database.php";

if (isset($_SESSION['error_message'])) {
  echo "{$_SESSION['error_message']}";
  unset($_SESSION['error_message']); // Supprimer le message d'erreur de la session
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"];
    $pwd = $_POST["pwd"];

    $sql = "SELECT * FROM users WHERE mail = ?";
    $params = array($mail);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if ($row && password_verify($pwd, $row['pwd'])) {
          // Authentification réussie
          $_SESSION['users'] = [
            "user_id"=>$row["user_id"],
            "lastname" => $row["lastname"],
            "firstname" => $row["firstname"],
            "mail" => $row["mail"],
            "role" => $row["role"]
          ]; // Stocke les informations de l'utilisateur en session

          if($row["role"] == 1) {
            //Administrateur connecté, renvoi vers le backoffice
            header('Location: backoffice/dashboard.php');
          }
          else {
            //Utilisateur connecté, redirigé vers l'index
            header('Location: index.php');
          }
          exit();
      } else {
          // Nom d'utilisateur ou mot de passe incorrect
          echo "<script>alert(\"Nom d'utilisateur ou mot de passe incorrect\")</script>";
      }
}
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <script src="boostrap/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body>
    <div class="formulaire">
      <main class="form-signin w-100 m-auto">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

          <h1 class="h3 mb-3 fw-normal">Se connecter</h1>

          <div class="form-floating">
            <input type="mail" class="form-control" id="mail" name="mail" placeholder="name@example.com" required>
            <label for="mail">Adresse mail</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="pwd" required>
            <label for="pwd">Mot de passe</label>
            <a class="forgot-pwd" href="forgot-pwd.php">Mot de passe oublié</a>
          </div>

          <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Se souvenir de moi
            </label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
          </br></br>
          <a href="register.php" class="btn btn-primary w-100 py-2">Créer un compte</a>
          <p class="mt-5 mb-3 text-body-secondary">ProjetFilRouge_InstitutLimayrac &copy; 2023</p>
        </form>
      </main>
    </div>
    <script src="boostrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>