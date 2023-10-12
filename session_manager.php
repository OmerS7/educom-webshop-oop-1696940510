<?php
session_start();
function doLoginUser($username, $userId) {
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $userId;
    $_SESSION['cart'] = array();
}

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

function getLoggedInUser() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    } else {
        return null; // Of een andere waarde die aangeeft dat de gebruiker niet is ingelogd
    }
}

function getLoggedInUserId() {
    if (isset($_SESSION['userId'])) {
        return $_SESSION['userId'];
    } else {
        return null; // Of een andere waarde die aangeeft dat de gebruiker niet is ingelogd
    }
}

function doLogoutUser() {
    session_unset();
    session_destroy();
}


function addToCart($productId){
    $cart = $_SESSION['cart'];
    if(!array_key_exists($productId,$cart)){
        $_SESSION['cart'][$productId]= 1;
    }else{
        $_SESSION['cart'][$productId]= $cart[$productId] +1;
    }
}

function getCart(){
    $cart = $_SESSION['cart'];
    return $cart;
}
    
function updateCart($productId, $amount){
    $cart = $_SESSION['cart'];
    if($productId && $amount && is_numeric($amount) && $amount > -1) {
        $_SESSION['cart'][$productId] = (int)$amount;
    }
    return $cart;
}

function deleteFromCart($productId){
    $cart = $_SESSION['cart'];
    if(isset($cart[$productId])) {
        unset($cart[$productId]);
    }

    $_SESSION['cart'] = $cart;

    return $cart;
}

function checkOutCart($id){
    $cart = $_SESSION['cart'];
    require_once ('db.repository.php');
    saveCheckOutCart($id, $cart);
    $_SESSION['cart'] = array();
    return $cart;
}
?>