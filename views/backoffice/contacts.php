<?php
session_start();
require_once "database.php";
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../login.php');
    exit();
  }

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if ($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])) {
    header('Location: ../login.php');
    exit();
}

// Récupérer les données de la table "contacts"
$sql = "SELECT * FROM contacts";
$stmt = $conn->query($sql);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/backoffice.css">
    <link href="boostrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Backoffice - Contacts</title>
</head>
<body>
    <h1>Backoffice - Contacts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?php echo $contact['name']; ?></td>
                    <td><?php echo $contact['mail']; ?></td>
                    <td><?php echo $contact['text']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
<footer>
    <?php require "footer.php" ?>
</footer> 
</html>
