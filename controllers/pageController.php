<?php
require_once('../views/userModel.php');
require_once('../views/shopModel.php');

class pageController{

    private $model;

    public function __construct() {
        $this->model = new PageModel(NULL);
    }

    public function handleRequest(){
        $this->getRequest();
        $this->procesRequest();
        $this-showResponse();
    }

    private getRequest(){
        $this->model->getRequestedPage();
    }

    private processRequest(){
        switch($this->model->page){
            case "login":
                require_once('login.php');
                $this->model = validateLogin();
                if ($this->['valid']){
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
                    $this->data = doChangePassword($this->model);
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
                    $this->model = doRegisterUser($data);
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
            require_once('../views/homeDoc.php');
            $view = new HomeDoc($this->model);
            break;
        }
    }
}
