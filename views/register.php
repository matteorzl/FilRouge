<?php

session_start();
if(isset($_SESSION["users"])){
  header('Location: compte.php');
  exit();
}
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["lastname"], $_POST["firstname"], $_POST["mail"], $_POST["pwd"])
     && !empty($_POST["lastname"])&& !empty($_POST["firstname"])&& !empty($_POST["mail"])&& !empty($_POST["pwd"])){
    
      $lastname = $_POST["lastname"];
      $firstname = $_POST["firstname"];
      $mail = $_POST["mail"];
      $pwd = $_POST["pwd"];

      //On verifie si un compte existe deja 
      $sql = "SELECT * FROM users WHERE mail = ?";
      $params = array($mail);
      $stmt = $conn->prepare($sql);
      $stmt->execute($params);
      
      $count = $stmt->fetchColumn();
      
      if ($count > 0) {
      // L'adresse e-mail existe déjà
      $_SESSION['error_message'] = "Cette adresse mail est déjà utilisée";
      header('Location: login.php');
      }else{


      // Hash du mot de passe
      $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

      $sql = "INSERT INTO users (lastname, firstname, mail, pwd) VALUES (?, ?, ?, ?)";
      $params = array($lastname, $firstname, $mail, $hashedpwd);

      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        $user_id=$conn->lastinsertId();

        $_SESSION['users'] = [
          "user_id"=> $user_id,
          "lastname" => $lastname,
          "firstname" => $firstname,
          "mail" => $mail,
          "role" => ["role"]
        ]; // Stocke les informations de l'utilisateur en session
        $_SESSION['message'] = "L'incription a été validé";
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
  }
}
else{
      echo "<script>alert(\"Toutes les informations de sont pas remplis\")</script>";
}}
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
    <link href="css/register.css" rel="stylesheet">
  </head>
  <body>
    <div class="formulaire">
      <main class="form-signin w-100 m-auto">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

          <h1 class="h3 mb-3 fw-normal">Créer un compte</h1>

          <div class="form-floating">
            <input type="lastname" class="form-control" id="lastname" name="lastname" placeholder="lastname" required>
            <label for="lastname">Nom</label>
          </div>

          <div class="form-floating">
            <input type="firstname" class="form-control" id="firstname" name="firstname" placeholder="firstname" required>
            <label for="firstname">Prenom</label>
          </div>

          <div class="form-floating">
            <input type="mail" class="form-control" id="mail" name="mail" placeholder="name@example.com" required>
            <label for="mail">E-mail</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="pwd" required>
            <label for="pwd">Mot de passe</label>
          </div>

          <button class="btn btn-primary w-100 py-2" type="submit">Créer un compte</button>

          <p class="mt-5 mb-3 text-body-secondary">ProjetFilRouge_InstitutLimayrac &copy; 2023</p>
        </form>
      </main>
    </div>
    <script src="boostrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>