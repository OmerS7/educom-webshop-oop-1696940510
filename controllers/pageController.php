<?php
require_once('models/usermodel.php');
require_once('models/shopModel.php');

class pageController{

    private $model;

    public function __construct() {
        $this->model = new pageModel(NULL);
    }

    public function handleRequest(){
        $this->getRequest();
        $this->processRequest();
        $this->showResponse();
    }

    private function getRequest(){
        $this->model->getRequestedPage();
    }

    private function processRequest(){
        switch($this->model->page){
            case "login":
                $this->model = new userModel($this->model);
                require_once('login.php');
                $this->model->validateLogin();
                if ($this->model->valid){
                    $this->model->doLoginUser();
                    $this->model->page = "home";
                }
                break;   
            case "contact":
                $this->model = new userModel($this->model);
                require_once('views/contactDoc.php');
                $this->model->validateContact();
                if($this->model->valid){
                    if ($this->model->succes) {
                        $this->model->doStoreContact();
                        $this->model->page = "thanks";
                    }
                }    
                break;      
            case "logout":
                require_once('logout.php');
                $this->model->doLogoutUser();
                $this->model->page = "home";
                break;
            case "changepassword":
                $this->model = new userModel($this->model);
                require_once('passwordC.php');
                $this->model->validatePassword();
                if ($this->model->valid){
                    $this->model->doChangePassword();
                    if ($this->model->succes) {
                        $this->model->page = "login";
                        $this->model['emailErr'] = "";
                        $this->model['password'] = "";
                    }
                }    
                break;
            case "register":
                $this->model = new userModel($this->model);
                require_once('register.php');
                $this->model->validateRegister();
                if($this->model->valid){
                    if ($this->model->succes){
                        $this->model = doRegisterUser($this->model);
                        $this->model->page = "home";
                    }
                }
                break;
            case "webshop":
                $this->model = new shopModel($this->model);
                require_once('webshop.php');
                $this->model->handleAction();
                $this->model->doRetreiveProducts();
                break;
            case "detail":
                $this->model = new shopModel($this->model);
                require_once('productDetail.php');
                $this->model->doRetreiveProductId();
                break;
            case "shoppingCart":
                $this->model = new shopModel($this->model);
                require_once('webshop.php');
                $this->model->handleAction();
                $this->model->doRetreiveShoppingCart();
                if ($this->model->succes) {
                    $this->genericErr = "Uw bestelling is succesvol afgehandeld! <br> Voor een volledig overzicht van jouw bestelling, klik op de icon 'Overzicht bestellingen' in de menubalk.";
                }
                break;
            case "orders":
                $this->model = new shopModel($this->model);
                require_once('orders.php');
                $this->model->doRetreiveOrders();
                break;
            case "orderDetail":
                $this->model = new shopModel($this->model);
                require_once('orderDetail.php');
                $this->model->doRetreiveOrderId();
                break;
        }  
    }


    private function showResponse(){
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
            require_once('views/productDetailDoc.php');
            $view = new productDetailDoc($this->model);
            break;
        case 'thanks':
            require_once('views/thanksDoc.php');
            $view = new thanksDoc($this->model);
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
        default:
            require_once('views/pageNotFoundDoc.php');
            $view = new pageNotFoundDoc($this->model);
            break;
        }   
        $view -> show();
    }
}

