<?php
ob_start();
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["password"])
     && !empty($_POST["nom"])&& !empty($_POST["prenom"])&& !empty($_POST["email"])&& !empty($_POST["password"])){
    
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      //On verifie si un compte existe deja 
      $sql = "SELECT * FROM users WHERE email = ?";
      $params = array($email);
      $stmt = $conn->prepare($sql);
      $stmt->execute($params);
      
      if (!empty($stmt)) {
      // L'adresse e-mail existe déjà
      echo "<script>alert(\"Cette adresse mail est deja utilisé\")</script>";
      ob_end_flush();
      header('Location: login.php');
      }else{


      // Hash du mot de passe
      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

      $sql = "INSERT INTO users (nom, prenom, email, pass, user_role) VALUES (?, ?, ?, ?, 0)";
      $params = array($nom, $prenom, $email, $hashedPassword);

      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        $id=$conn->lastinsertId();

        $_SESSION['users'] = [
          "id"=> $id,
          "nom" => $nom,
          "prenom" => $prenom,
          "email" => $email,
          "roles" => ["user_role"]
        ]; // Stocke les informations de l'utilisateur en session

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

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/register.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
    </svg>
    <main class="form-signin w-100 m-auto">
      <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <h1 class="h3 mb-3 fw-normal">Créer un compte</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
          <label for="nom">Nom</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
          <label for="prenom">Prenom</label>
        </div>

        <div class="form-floating">
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
          <label for="email">Adresse mail</label>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Mot de passe</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Créer un compte</button>

        <p class="mt-5 mb-3 text-body-secondary">ProjetFilRouge_InstitutLimayrac &copy; 2023</p>
      </form>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>