<?php

require_once("session_manager.php");
require_once("utils.php");


class PageModel {
 
   public $page;
   protected $isPost = false;
   public $menu;
   public $errors = array();
   public $genericErr = "";
   protected $sessionManager;
   

   public function __construct($copy) {
      if (empty($copy)) {
          $this->sessionManager = new SessionManager();
       } else {
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
  
    protected function setPage($newPage) {
        $this->page = $newpage;
    } 
   
    protected function getArrayVar($array, $key, $default=''){
        return isset ($array[$key]) ? $array[$key] : $default;
    }

    protected function getPostVar($key, $default = '') {
        return getArrayVar($_POST, $key, $default);
    }
          
    protected function getUrlVar($key, $default = '') {
        return getArrayVar($_GET, $key, $default);
    }

   public function createMenu() {
	   $this->menu['home'] = new MenuItem('home', 'HOME');
       $this->menu['about'] = new MenuItem('about', 'ABOUT');
       $this->menu['contact'] = new MenuItem('contact', 'CONTACT');
       $this->menu['webshop'] = new MenuItem('webshop', '','NikeLogoWhite.png');
       if ($this->sessionManger->isUserLoggedIn()) {
            $this->menu['logout'] = new MenuItem('logout',"", "logout.svg", 
            $this->sessionManager->getLoggedInUser()['name']);
            $this->menu['shoppingCart'] = new MenuItem('shoppingCart', 'SHOPPING CART', 'cart.svg');
            $this->menu['orders'] = new MenuItem('orders', 'ORDERS', 'cartorders.svg');
            $this->menu['changepassword'] = new MenuItem('changepassword', 'CHANGE PASSWORD', 'lock.svg');
        } else {
            $this->menu['register'] = new MenuItem('register', 'REGISTER');
            $this->menu['login'] = new MenuItem('login', 'LOGIN');
        }
    }
}
