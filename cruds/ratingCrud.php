<?php

class ratingCrud{

    private $crud;  

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function saveProductRating($productId, $userId, $rating){
        $sql="INSERT INTO productRating ($productId, $userId, $rating) 
              VALUES (:productId, :userId, :rating)";
        $params= ['productId'=> $productId, 'userId' => $userId, 
                  'rating' => $rating];
        return $this->crud->createRow($sql, $params);
    }

    public function updateProductRating($productId, $userId, $rating) {
        $sql = "UPDATE productRating SET rating = :rating 
                WHERE productId = :productId AND userId = :userId";
        $params = ['rating' => $rating,'productId' => $productId, 
                   'userId' => $userId];
        return $this->crud->updateRow($sql, $params);
    }
    
    public function getAvarageRating($productId){
        $sql="SELECT productId, AVG(rating) AS averageRating 
             FROM productRating WHERE productId = :productId";
        $params = ['productId' => $productId];
        return $this->crud->readOneRow($sql, $params);
    }

    public function getAllAvarageRating($productId){
        $sql="SELECT productId, AVG(rating) AS averageRating 
             FROM productRating GROUP BY productId";
        $params = [];
        return $this->crud->readManyRows($sql, $params);
    }


}   