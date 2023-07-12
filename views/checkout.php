<?php
    session_start();
    if(!isset($_SESSION["users"])){
    header('Location: login.php');
    }
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
                document.getElementById('city_livr').value = document.getElementById('city_fact').value;
                document.getElementById('region_livr').value = document.getElementById('region_fact').value;
                document.getElementById('code_postal_livr').value = document.getElementById('code_postal_fact').value;
                document.getElementById('country_livr').value = document.getElementById('country_fact').value;
            } else {
                document.getElementById('billing_address').value = '';
                document.getElementById('city_fact').value = '';
                document.getElementById('region_fact').value = '';
                document.getElementById('code_postal_fact').value = '';
                document.getElementById('country_fact').value = '';
            }
        }
    </script>
    </head>
    <body>
        <div class="checkout">
          <h1 class="titleCheckout">Checkout</h1>
            <form action="process_payment.php" method="post">
              <div class="form-row inline-labels">
                <div>
                  <label for="first_name">Prénom :</label>
                  <input type="text" id="first_name" name="first_name" required>
                </div>
                <div>
                  <label for="last_name">Nom :</label>
                  <input type="text" id="last_name" name="last_name" required>
                </div>
              </div>
              <label for="shipping_address">Adresse de livraison :</label>
              <textarea id="shipping_address" name="shipping_address" required></textarea>

             <div class="form-row inline-labels">
              <label for="city_livr">Ville :</label>
              <input type="text" id="city_livr" name="city_livr" required>
              <label for="region_livr">Region :</label>
              <input type="text" id="region_livr" name="region_livr" required>
            </div>

            <div class="form-row inline-labels">
              <label for="code_postal_livr">CP :</label>
              <input type="text" id="code_postal_livr" name="code_postal_livr" required>
              <label for="country_livr">Pays :</label>
              <input type="text" id="country_livr" name="country_livr" required>
            </div>
          
            <label for="number">Numero de telephone :</label>
            <input type="tel" id="number" name="number" required>
              
            <div class="sameForBilling">
              <input class="checkbox" type="checkbox" id="same_address_checkbox" onclick="copyAddress()">
              <label for="same_address_checkbox">Utiliser la même adresse pour la facturation</label>
            </div>
          
            <label for="billing_address">Adresse de facturation :</label>
            <textarea id="billing_address" name="billing_address" required></textarea>
          
            <div class="form-row inline-labels">
              <label for="city_fact">Ville :</label>
              <input type="text" id="city_fact" name="city_fact" required>
              <label for="region_fact">Region :</label>
              <input type="text" id="region_fact" name="region_fact" required>
            </div>

            <div class="form-row inline-labels">
              <label for="code_postal_fact">CP :</label>
              <input type="text" id="code_postal_fact" name="code_postal_fact" required>
              <label for="country_fact">Pays :</label>
              <input type="text" id="country_fact" name="country_fact" required>
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
       <footer class="footer">
        <?php require "footer.php" ?>
       </footer>
    </body>
</html>