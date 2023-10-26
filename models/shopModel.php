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
                    $id= $this->getSavePostVar('productId');
                    deleteFromCart($id);
                    break;
                case 'checkOutCart':
                    $id= $this->getLoggedInUserId();
                    $this->sessionManager->checkOutCart($id);
                    $this->genericErr = "Uw bestelling is succesvol afgehandeld! <br> Voor een volledig overzicht van jouw bestelling, klik op de icon 'Overzicht bestellingen' in de menubalk.";
                    var_dump($this->genericErr);
                    break;
            }
    }

    function doRetreiveProductId(){
        $this->model = array();
        $data['succes'] = false;
        try{
            require_once ('productService.php');
            $this->productId = $this->getSaveUrlVar($this->id);
            $this->products = $this->getProducts($this->productId);
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }

    public function doRetreiveProducts(){
       $this->model = array();
        try{
            require_once 'productService.php';
            $this->products = getProducts();
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }

    function doRetreiveOrders(){
        try{
            require_once 'productService.php';
            $userId = getLoggedInUserId();
            $this->orders = getOrders($userId);
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Order retreiving failed: " . $e -> getMessage());
        }
    }

    function doRetreiveShoppingCart(){
        try{
            require_once 'productService.php';
            $this->products = getProducts();
            $cart = $this->sessionManager->getCart();
            $this->totalPrice = 0;
            var_dump($cart);
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
            logerror("Product retreiving failed: " . $e -> getMessage());
        }
    }
}