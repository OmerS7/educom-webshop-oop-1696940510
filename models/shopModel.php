<?php
require_once('pageModel.php');
require_once('sessionManager.php');

class shopModel extends pageModel{
    public $id = -1;
    public $userId= -1;
    public $productId= -1;
    public $price=array();
    public $products = array();
    public $product = "";
    public $productName= array();
    public $orders ="";
    public $success = false;

    public function __construct($pageModel, $shopCrud) {
        PARENT::__construct($pageModel);
        $this->shopCrud = $shopCrud;
    }

    public function setSuccessMessage($message) {
        $this->successMessage = $message;
    }

    public function getSuccessMessage() {
        return $this->successMessage;
    }

    public function handleAction(){
        $action = $this->getSavePostVar("action");
            switch($action){
                case 'addToCart':
                    $id= $this->getSavePostVar('id');
                    $this->page = $this->getSavePostVar('page');
                    $this->sessionManager->addToCart($id);
                    break;
                case 'updateCart':
                    $id= $this->getSavePostVar('id');
                    $amount = $this->getSavePostVar('amount');
                    updateCart($id, $amount);
                    break;
                case 'deleteFromCart':
                    $id= $this->getSavePostVar('id');
                    deleteFromCart($id);
                    break;
                case 'checkOutCart':
                    $id= $this->getLoggedInUserId();
                    $this->sessionManager->checkOutCart($id);
                    $this->succes= true;
                    break;
            }
    }


    public function doRetreiveProducts(){
        try{
            require_once 'productService.php';
            $this->products = getProducts();
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }

    public function doRetreiveProductId(){
        try{
            require_once ('productService.php');
            $productId = $this->getSaveUrlVar('id');
            $this->product = getProduct($productId);
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }

    public function doRetreiveShoppingCart(){
        try{
            require_once 'productService.php';
            $this->products = getProducts();
            $cart = $this->sessionManager->getCart();
            $this->totalPrice = 0;
            foreach($cart as $productId => $amount){
                if (!array_key_exists($productId, $this->products)) {
                    continue;
                }
                $product = $this->products[$productId];

                $subTotal = $product['price'] * $amount;
                $this->totalPrice += $subTotal;

                $this->cartLines[] = [
                    "productId" => $productId, 
                    "amount" => $amount,
                    "subTotal" => $subTotal, 
                    "productName" => $product['productname'], 
                    "image" => $product['productimage'],
                    "price" => $product['price']
                ]; 
            }
            
            $this->succes = true;
        }
        catch(Exception $e){
            $this->model['genericErr']="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }

    public function getOrders(){
        try{
            require_once 'productService.php';
            $userId = getLoggedInUserId();
            $this->orders = getAllOrders($userId);
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->$this->logerror("Order retreiving failed: " . $e -> getMessage());
        }
    }

    public function doRetreiveOrderId(){
        try{
            $id = getPostVar('id');
            $userId = getLoggedInUserId();
            $this->orders = getOrder($id, $userId);
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->$this->logerror("Order retreiving failed: " . $e -> getMessage());
        }
    }
}