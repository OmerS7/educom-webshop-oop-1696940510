<?php
require_once('pageModel.php');
require_once('sessionManager.php');

class shopModel extends pageModel{
    public $id = -1;
    public $userId= -1;
    public $products ="";
    public $success = false;

    public function handleAction(){
        $action = $this->getSavePostVar("action");
            switch($action){
                case 'addToCart':
                    $this->id= getPostVar('productId');
                    $this->page = getPostVar('page');
                    $this->sessionManager->addToCart($this->id);
                    break;
                case 'updateCart':
                    $this->id= getPostVar('productId');
                    $this->amount = getPostVar('amount');
                    updateCart($this->id, $this->amount);
                    break;
                case 'deleteFromCart':
                    $this->id= getPostVar('productId');
                    deleteFromCart($id);
                    break;
                case 'checkOutCart':
                    $this->id= getLoggedInUserId();
                    checkOutCart($this->id);
                    $this->genericErr = "Uw bestelling is succesvol afgehandeld! <br> Voor een volledig overzicht van jouw bestelling, klik op de icon 'Overzicht bestellingen' in de menubalk.";
                    break;
            }
    }

    function doRetreiveProductId(){
        $this->model = array();
        $data['succes'] = false;
        try{
            require_once 'productService.php';
            $productId = getUrlVar('id');
            $data['product'] = getProduct($productId);
            $data['succes'] = true;
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
        $this->model = array();
        try{
            require_once 'productService.php';
            $this->userId = getLoggedInUserId();
            $this->model->orders = getOrders($userId);
            $this->model->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Order retreiving failed: " . $e -> getMessage());
        }
        return $data;
    }

    function doRetreiveShoppingCart(){
        $this->model = array();
        $this->model['succes'] = false;
        try{
            require_once 'productService.php';
            $this->products = getProducts();
            $this->cart = getCart();
            $this->totalPrice = 0;
            $this->data['cartLines'] = array();
            foreach($this->cart as $this->productId => $this->amount){
                $this->product = $this->products[$this->productId];
                $this->subTotal = $this->product['price'] * $this->amount;
                $this->totalPrice += $this->subTotal;
                $this->data['cartLines'][] = array("productId" => $this->productId, "amount" => $this->amount,
                                             "subTotal" => $this->subTotal, "name" => $this->product["productname"], 
                                             "image" => $this->product["productimage"], "price" => $this->product["price"]); 
            }
            $this->model["totalPrice"] = $this->totalPrice;
            $this->model['succes'] = true;
        }
        catch(Exception $e){
            $this->model['genericErr']="Er is een technische storing. Probeer het later nog eens.";
            logerror("Product retreiving failed: " . $e -> getMessage());
        }
        return $this->model;
    }
}