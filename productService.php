<?php
require_once 'db.repository.php';

function getProducts(){
    return getAllProducts();
}

function getProduct($id){
    return getProductById($id);
}

function getOrders($userId){
    return getAllOrders($userId);
}

function getOrder($id, $userId){
    return getOrderById($id);
}