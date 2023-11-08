<?php
require_once('pageModel.php');


class RatingModel extends pageModel{

    private $ratingCrud;
    public $id = -1;
    public $userId= -1;
    public $productId= -1;

    public function __construct($pageModel, $ratingCrud) {
        PARENT::__construct($pageModel);
        $this->ratingCrud = $ratingCrud;
    }

    public function getRatingById($productId) {
        try {
            $averageRatingData = $this->crud->getAverageRating($productId);

            if ($averageRatingData !== null) {
                return $averageRatingData['averageRating'];
            } else {
                return null;
            }
        } catch (Exception $e) {
            $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
            $this->logerror("logIn failed: " . $e -> getMessage());
        }
    }

    public function saveRating($productId, $userId, $rating) {
        try {
            $result = $this->crud->saveProductRating($productId, $userId, $rating);
            return $result;
        } catch (Exception $e) {
            $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
            $this->logerror("logIn failed: " . $e -> getMessage());
        }
    }

    public function updateRating($productId, $userId, $rating) {
        try {
            $result = $this->crud->updateProductRating($productId, $userId, $rating);
            return $result;
        } catch (Exception $e) {
            $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
            $this->logerror("logIn failed: " . $e -> getMessage());
        }
    }
}






