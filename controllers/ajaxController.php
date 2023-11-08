<?php
require_once('models/userModel.php');
require_once('models/shopModel.php');
require_once('models/ratingModel.php');


class ajaxController{

    private $model;
    private $modelFactory;
    private $ratingCrud;

    public function __construct($modelFactory) {
        $this->modelFactory = $modelFactory;
        $this->model = $this->modelFactory->createModel('page');
        $this->ratingCrud = new ratingCrud($this->modelFactory->createModel('rating'));
    }

    public function handleRequest(){
        $this->getRequest();
        $this->processRequest();
        $this->showResponse();
    }

    private function getRequest(){
        $this->model->getRequestedPage();
    }

    public function handleActions() {
        $function = $this->model->getSaveUrlVar("function");
        $productId = $this->model->getSaveUrlVar("id");
    
        if ($this->model->isPost) {
            $rating = $this->model->getSaveUrlVar("rating");
        }
    
        if ($function === 'addRating') {
            $userId = $this->model->getLoggedInUserId();
            $result = $this->ratingCrud->updateProductRating($productId, $userId, $rating);
    
            if ($result) {
                $averageRating = $this->ratingCrud->getAverageRating($productId);
                echo json_encode(['averageRating' => $averageRating]);
            } else {
                echo json_encode(['error' => 'Fout bij het toevoegen/updaten van de rating']);
            }
            exit(); // Stop verdere verwerking van het verzoek
        }
    }

    public function getRatingById($id) {
        try {
            // functie getAvarageRating aanroepen om de gemiddelde rating voor een product op te halen
            $averageRatingData = $this->crud->getAvarageRating($id);

            if ($averageRatingData !== null) {
                echo json_encode($averageRatingData);
            } else {
                echo json_encode(array('error' => 'Geen rating gevonden'));
            }
        } catch (Exception $e) {
            echo json_encode(array('error' => 'Er is een fout opgetreden'));
        }
    }
}



  