<?php
require_once('models/pageModel.php');
// require_once('models/shopModel.php');

class pageController{

    private $model;

    public function __construct() {
        $this->model = new pageModel(NULL);
    }

    public function handleRequest(){
        $this->getRequest();
        $this->procesRequest();
        $this-showResponse();
    }

    private function getRequest(){
        $this->model->getRequestedPage();
    }

    private function processRequest(){
        switch($this->model->page){
            case "login":
                require_once('login.php');
                $this->model = validateLogin();
                if ($this->valid){
                    doLoginUser($this->model['username'], $this->model['userId']);
                    $this->model->page = "home";
                }
                break;   
            case "contact":
                require_once('contact.php');
                $this->model = validateContact();
                if($this->model['valid']){
                    $this->model = doStoreContact($this->model);
                    if ($this->model['succes']) {
                        $this->model->page = "thanks";
                    }
                }    
                break;      
            case "logout":
                require_once('logout.php');
                doLogoutUser();
                $this->model->page = "home";
                break;
            case "changepassword":
                require_once('passwordC.php');
                $this->model = validatePassword();
                if ($this->model['valid']){
                    $this->model = doChangePassword($this->model);
                    if ($this->model['succes']) {
                        $this->model->page = "login";
                        $this->model['emailErr'] = "";
                        $this->model['password'] = "";
                    }
                }    
                break;
            case "register":
                require_once('register.php');
                $this->model = validateRegister();
                if($this-model['valid']){
                    $this->model = doRegisterUser($this->model);
                    if ($this->model['succes']){
                        $this->model->page = "home";
                    }
                }
                break;
            case "webshop":
                require_once('webshop.php');
                handleAction();
                $this->model = doRetreiveProducts();
                break;
            case "detail":
                require_once('productDetail.php');
                $this->model = doRetreiveProductId();
                break;
            case "shoppingCart":
                require_once('webshop.php');
                $this->model = handleAction();
                $this->model = array_merge($this->model,doRetreiveShoppingCart());
                break;
            case "orders":
                require_once('orders.php');
                $this->model = doRetreiveOrders();
                break;
            case "orderDetail":
                require_once('orderDetail.php');
                $this->model = doRetreiveOrderId();
                break;
        }  
    }

    private function showResponce(){
       $this->model->createMenu();

       switch($this->model->page){
        case 'home':
            require_once('views/homeDoc.php');
            $view = new homeDoc($this->model);
            break;
        case 'about':
            require_once('views/aboutDoc.php');
            $view = new aboutDoc($this->model);
            break;
        case 'contact':
            require_once('views/contactDoc.php');
            $view = new contactDoc($this->model);
            break;
        case 'webshop':
            require_once('views/webshopDoc.php');
            $view = new webshopDoc($this->model);
            break;
        case 'shoppingCart':
            require_once('views/shoppingCartDoc.php');
            $view = new shoppingCartDoc($this->model);
            break;
        case 'checkOutCart':
            require_once('shoppingCart.php');
            showCheckOutCartContent($this->model);
            break;
        case 'orders':
            require_once('views/ordersDoc.php');
            $view = new ordersDoc($this->model);
            break;
        case 'orderDetail':
            require_once('orderDetail.php');
            showOrderDetailContent($this->model);
            break;
        case 'detail':
            require_once('productDetail.php');
            showProductDetailContent($this->model);
            break;
        case 'thanks':
            require_once('contact.php');
            showContactThanks($this->model);
            break;
        case 'register':
            require_once('views/registerDoc.php');
            $view = new registerDoc($this->model);
            break;
        case 'login':
            require_once('views/loginDoc.php');
            $view = new loginDoc($this->model);
            break;
        case 'changepassword':
            require_once('views/passwordCDoc.php');
            $view = new passwordCDoc($this->model);
            break;
        case 'logout':
            doLogoutUser();
            require_once('home.php');
            showHomeContent();
            break;   
        default:
            showPageNotFound();
            break;
        }   
        $view -> show();
    }
}

