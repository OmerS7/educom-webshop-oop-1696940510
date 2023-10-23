<?php

require_once("models/sessionManager.php");
require_once("models/menuItem.php");


class pageModel {
 
   public $page;
   protected $isPost = false;
   public $menu;
   public $errors = array();
   public $genericErr = "";
   protected $sessionManager;
   
   public function __construct($copy) {
    if (empty($copy)) {
        // ==> First instance of PageModel
        $this->sessionManager = new SessionManager();
     } else {
        // ==> Called from the constructor of an extended class.... 
        $this->page = $copy->page;
        $this->isPost = $copy->isPost;
        $this->menu = $copy->menu;
        $this->genericErr = $copy->genericErr;
        $this->sessionManager = $copy->sessionManager; 
     }
 }

   public function getRequestedPage() {

      $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');

      if ($this->isPost) {
          $this->setPage($this->getPostVar("page", "home"));
      } else {
          $this->setPage($this->getUrlVar("page", "home"));
      }
   }
  
    public function setPage($newPage) {
        $this->page = $newPage;
    } 
   
    protected function getArrayVar($array, $key, $default=''){
        return isset ($array[$key]) ? $array[$key] : $default;
    }

    protected function getPostVar($key, $default = '') {
        return $this->getArrayVar($_POST, $key, $default);
    }
          
    protected function getUrlVar($key,$default='') {
        return $this->getArrayVar($_GET, $key, $default);
    }
  
   public function createMenu() {
	   $this->menu['home'] = new menuItem('home', 'HOME');
       $this->menu['about'] = new menuItem('about', 'ABOUT');
       $this->menu['contact'] = new menuItem('contact', 'CONTACT');
       $this->menu['webshop'] = new menuItem('webshop', '','NikeLogoWhite.png');
       if ($this->sessionManager->isUserLoggedIn()) {
            $this->menu['logout'] = new menuItem('logout',"", "logout.svg", 
            $this->sessionManager->getLoggedInUser()['name']);
            $this->menu['shoppingCart'] = new menuItem('shoppingCart', 'SHOPPING CART', 'cart.svg');
            $this->menu['orders'] = new menuItem('orders', 'ORDERS', 'cartorders.svg');
            $this->menu['changepassword'] = new menuItem('changepassword', 'CHANGE PASSWORD', 'lock.svg');
        } else {
            $this->menu['register'] = new menuItem('register', 'REGISTER');
            $this->menu['login'] = new menuItem('login', 'LOGIN');
        }
    }
}
