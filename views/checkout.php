<?php
    require_once "database.php";
    require_once "header.php";

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Checkout</title>
        <link rel="stylesheet" href="css/checkout.css">
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
        <div class="checkout">
          <h1 class="titleCheckout">Checkout</h1>
        <form action="process_payment.php" method="post">
            <div class="form-row inline-labels">
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <label for="shipping_address">Adresse de livraison :</label>
            <textarea id="shipping_address" name="shipping_address" required></textarea>

            <label for="billing_address">Adresse de facturation :</label>
            <textarea id="billing_address" name="billing_address" required></textarea>

            <div class="sameForBilling">
                <input class="checkbox" type="checkbox" id="same_address_checkbox" onclick="copyAddress()">
                <label for="same_address_checkbox">Utiliser la même adresse pour la facturation</label>
            </div>

            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="card_number">Numéro de carte :</label>
            <input type="text" id="card_number" name="card_number" required>
            
            <div class="form-row inline-labels">
            <label for="exp_date">Date d'expiration :</label>
            <input type="text" id="exp_date" name="exp_date" placeholder="MM/YY" required>
            <label for="cvv">CVV :</label>
            <input type="text" id="cvv" name="cvv" required>
            </div>
              
            <input type="submit" value="Payer">
        </form>
       </div>
    </body>
    <footer>
        <?php require "footer.php" ?>
    </footer> 
</html>