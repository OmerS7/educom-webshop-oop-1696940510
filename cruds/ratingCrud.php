<?php

class ratingCrud{

    private $crud;  

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function saveProductRating(){
        $sql="INSERT INTO productRating ($productId, $userId, $rating) 
              VALUES (:productId, :userId, :rating)";
        $params= ('productId'=> $productId, 'userId' => $userId, 'rating' => $rating);
        return $this->crud->createRow($sql, $params);
    }


}