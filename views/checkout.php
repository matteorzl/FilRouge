<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if(!isset($_SESSION["users"])){
    header('Location: login.php');
    }
    require_once "database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lastname = $_POST["last_name"];
        $user_id = $_SESSION["users"]["user_id"];
        $firstname = $_POST["first_name"];
        $email = $_POST["email"];
        $shipping = $_POST["shipping_address"];
        $city_livr = $_POST["city_livr"];
        $region_livr = $_POST["region_livr"];
        $code_postal_livr = $_POST["code_postal_livr"];
        $country_livr = $_POST["country_livr"];
        $phone = $_POST["number"];
        $billing = $_POST["billing_address"];
        $city_fact = $_POST["city_fact"];
        $region_fact = $_POST["region_fact"];
        $code_postal_fact = $_POST["code_postal_fact"];
        $country_fact = $_POST["country_fact"];
        $card_name = $_POST["card_name"];
        $card_number = $_POST["card_number"];
        $dateString = $_POST["exp_date"];
        $cvv = $_POST["cvv"];
        $total = $_SESSION["total"]["total"];
    
        // Préparation des requêtes préparées pour éviter les injections SQL
    
        $deliverieQuery = $conn->prepare("INSERT INTO deliveries (user_id, lastname, firstname, address_1, city, region, [postal-code], country, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $billingQuery = $conn->prepare("INSERT INTO billings (user_id, lastname, firstname, address_1, city, region, [postal-code], country) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
        $payQuery = $conn->prepare("INSERT INTO payments (user_id, name, number, expiration, cvv) 
            VALUES (?, ?, ?, ?, ?)");

        if ($deliverieQuery->execute([$user_id, $lastname, $firstname, $shipping, $city_livr, $region_livr, $code_postal_livr, $country_livr, $phone])){
            $deliveryId = $conn->lastinsertId();

            if($billingQuery->execute([$user_id, $lastname, $firstname, $billing, $city_fact, $region_fact, $code_postal_fact, $country_fact])){
                $billingId = $conn->lastinsertId();

                if ($payQuery->execute([$user_id, $card_name, $card_number, date('Y-m-d', strtotime('28 ' . date('M Y', strtotime($dateString)))) , $cvv])){
                    $paymentId = $conn->lastinsertId();

                    $orderQuery = $conn->prepare("INSERT INTO orders (user_id, delivery_id, billing_id, payment_id, date_order, date_billing,rising, payment_method, [status]) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $orderQuery->execute([$user_id, $deliveryId, $billingId, $paymentId, $total,'carte bleu','En preparation']);
                    $orderId = $conn->lastinsertId();

                    $ids = array_keys($_SESSION["cart"]);
                    $idsString = implode(",", $ids);
                
                    $stmt = $conn->query("SELECT * FROM products WHERE product_id IN ($idsString)");
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($products as $product){
                        $product_id = $product["product_id"];
                        $price = $product["price"];
                        $quantity = $_SESSION["cart"][$product["product_id"]];
                        $order_product = $conn->prepare("INSERT INTO [orders-product] (order_id, product_id, price, quantity)
                                                          VALUES ( ?, ?, ?, ?)");
                        $order_product->execute([$order_id, $product_id, $price, $quantity]);
                    }

                    echo "Votre paiement a été accepté";
                }else {
                    echo "Une erreur s'est produite lors de l'insertion des données : ";
            }
            }else {
                echo "Une erreur s'est produite lors de l'insertion des données : ";
            }
        } else {
            echo "Une erreur s'est produite lors de l'insertion des données : ";
        }

    }
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
                document.getElementById('city_fact').value = document.getElementById('city_livr').value;
                document.getElementById('region_fact').value = document.getElementById('region_livr').value;
                document.getElementById('code_postal_fact').value = document.getElementById('code_postal_livr').value;
                document.getElementById('country_fact').value = document.getElementById('country_livr').value;
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
            <form method="post">
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

            <label for="card_name">Titulaire de la carte :</label>
            <input type="text" id="card_name" name="card_name" required>

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