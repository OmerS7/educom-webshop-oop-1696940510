<?php
require_once('models/userModel.php');
require_once('models/shopModel.php');
require_once('models/ratingModel.php');

// Maak een instantie van de ratingCrud
$ratingCrud = new ratingCrud(new Crud());

// Haal de benodigde gegevens uit de GET-parameters
$productId = $_GET['id']; // Hier ga ik ervan uit dat 'id' de product Id is die je wilt opvragen.
$userId = $_SESSION['userId']; // Hier ga ik ervan uit dat je de gebruikerssessie gebruikt om de gebruiker te identificeren.

// Roep de methode aan om de rating op te vragen
$ratingData = $ratingCrud->getRatingById($productId, $userId);

// Genereer en stuur de JSON-reactie terug
if ($ratingData !== null) {
    echo json_encode($ratingData);
} else {
    echo json_encode(array('error' => 'Geen rating gevonden'));
}
?>