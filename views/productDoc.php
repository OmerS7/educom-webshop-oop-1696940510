<?php
require_once('basicDoc.php');

abstract class productDoc extends basicDoc{
    abstract public function showProduct();
    abstract public function addToCart();
}