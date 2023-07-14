<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées via la requête POST
    $carousel_id = $_POST['carousel_id'];
    $image_number = $_POST['image_number'];
    $new_image = $_POST['new_image'];

    try {

        // Préparer la requête de mise à jour
        $sql = "UPDATE carousel SET image{$image_number} = :new_image WHERE carousel_id = :carousel_id";
        $stmt = $conn->prepare($sql);

        // Lier les valeurs des paramètres
        $stmt->bindParam(':new_image', $new_image);
        $stmt->bindParam(':carousel_id', $carousel_id);

        // Exécuter la requête de mise à jour
        $stmt->execute();

        // Fermer la connexion à la base de données
        $conn = null;

        // Envoyer une réponse indiquant que la mise à jour a réussi
        http_response_code(200);
        echo "Mise à jour de l'image du carrousel réussie";
    } catch (PDOException $e) {
        // En cas d'erreur, envoyer une réponse avec le code d'erreur et le message d'erreur
        http_response_code(500);
        echo "Erreur lors de la mise à jour de l'image du carrousel : " . $e->getMessage();
    }
} else {
    // Si la requête n'est pas de type POST, envoyer une réponse indiquant une méthode non autorisée
    http_response_code(405);
    echo "Méthode non autorisée";
}
