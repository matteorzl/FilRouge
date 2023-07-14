<?php
// Récupérer les informations de l'image à changer à partir de l'URL
$carousel_id = $_GET['carousel_id'];
$image_number = $_GET['image_number'];

// Récupérer les informations du produit à partir de la base de données
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher les produits avec un bouton "Sélectionner"
?>
<div>
    <h2>Produits</h2>
    <div>
        <?php foreach ($products as $product): ?>
            <img src="<?=$product['image1']?>" alt="Produit">
            <button class="selectbutton" onclick="updateCarouselImage(<?=$carousel_id?>, <?=$image_number?>, '<?=$product['image1']?>')">Sélectionner</button>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function updateCarouselImage(carousel_id, image_number, new_image) {
        // Préparez les données pour la requête de mise à jour
        var formData = new FormData();
        formData.append('carousel_id', carousel_id);
        formData.append('image_number', image_number);
        formData.append('new_image', new_image);

        // Envoie de la requête de mise à jour à un fichier PHP qui exécutera la requête SQL
        fetch('update_carousel_image.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            // Vérifier la réponse de la requête
            if (response.ok) {
                // Rediriger l'utilisateur vers la page carousel.php après la mise à jour
                window.location.href = 'carousel.php';
            } else {
                console.log('Erreur lors de la mise à jour de l\'image du carrousel');
            }
        })
        .catch(function(error) {
            console.log('Erreur lors de la mise à jour de l\'image du carrousel:', error);
        });
    }
</script>
