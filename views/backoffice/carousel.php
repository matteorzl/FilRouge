<?php
// Récupérer les informations du carrousel à partir de la base de données
$stmt = $conn->query("SELECT * FROM carousel");
$carousel = $stmt->fetch(PDO::FETCH_ASSOC);

// Afficher les images du carrousel avec un bouton "Changer"
?>
<div>
    <h2>Carrousel</h2>
    <div>
        <img src="<?=$carousel['image1']?>" alt="Image 1">
        <button class="changebutton" onclick="window.location.href='modifycarousel.php?carousel_id=<?=$carousel['carousel_id']?>&image_number=1'">Changer</button>
    </div>
    <div>
        <img src="<?=$carousel['image2']?>" alt="Image 2">
        <button class="changebutton" onclick="window.location.href='modifycarousel.php?carousel_id=<?=$carousel['carousel_id']?>&image_number=2'">Changer</button>
    </div>
    <div>
        <img src="<?=$carousel['image3']?>" alt="Image 3">
        <button class="changebutton" onclick="window.location.href='modifycarousel.php?carousel_id=<?=$carousel['carousel_id']?>&image_number=3'">Changer</button>
    </div>
</div>
