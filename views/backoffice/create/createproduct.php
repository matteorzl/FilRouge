<?php
session_start();
if($_SESSION["users"]["role"] != 1 || !isset($_SESSION["users"])){
    header('Location: ../../compte.php');
    exit();
  }

require_once "header.php";
require_once "../../database.php";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/createproduct.css">
    <script>
        function copyAddress() {
            if (document.getElementById('same_address_checkbox').checked) {
                document.getElementById('billing_address').value = document.getElementById('shipping_address').value;
            } else {
                document.getElementById('billing_address').value = '';
            }
        }
    </script>
    </head>
    <body>
        <div class="createproduct">
            <h1 class="titleCreateProduct">Créer produit</h1>
            <form action="../products.php" method="post">
            <div class="form-row inline-labels">
                <label for="first_name">Nom</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="last_name">Description</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <label for="shipping_address">Matériau :</label>
            <textarea id="shipping_address" name="shipping_address" required></textarea>

            <label for="billing_address">Quantité :</label>
            <textarea id="billing_address" name="billing_address" required></textarea>


            <label for="email">Prix :</label>
            <input type="email" id="email" name="email" required>

            <label for="card_number">Image :</label>
            <input type="text" id="card_number" name="card_number" required>

            <select name="category" id="category">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Payer">
        </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>