<?php
require_once ('../views/htmlDoc.php');

$view=new HtmlDoc();
$view-> show();

class BasisCdoc extends HtmlDoc{
    protected $data;
    public function __contruct($myData){
        $this->data = $myData;
    }
    private function showHeader(){
        echo '<header><h1>';
    switch($page)
   {
    case 'home':
        require_once('home.php');
        showHomeHeader();
        break;
    case 'about':
        require_once('about.php');
        showAboutHeader();
        break;
    case 'webshop':
        require_once('webshop.php');
        showWebshopHeader();
        break;
    case 'shoppingCart':
        require_once('shoppingCart.php');
        showShoppingCartHeader();
        break;
    case 'updateCart':
        require_once('shoppingCart.php');
        showShoppingCartHeader();
        break;
    case 'deleteFromCart':
        require_once('shoppingCart.php');
        showShoppingCartHeader();
        break;
    case 'checkOutCart':
        require_once('shoppingCart.php');
        showShoppingCartHeader();
        break;
    case 'orders':
        require_once('orders.php');
        showOrdersHeader();
        break;
    case 'orderDetail':
        require_once('orderDetail.php');
        showOrderDetailHeader();
        break;
    case 'contact':
        require_once ('contact.php');
        showContactHeader();
        break;
    case 'register':
        require_once ('register.php');
        showRegisterHeader();
        break;
    case 'login':
        require_once('login.php');
        showLoginHeader();
        break;
    case 'changepassword':
        require_once('passwordC.php');
        showChangePasswordHeader();
        break;

   }
   
    echo '</h1></header>' . PHP_EOL;
    }
    private function showMenuItem(){
        echo '<li><a href="index.php?page=' . $page . '">';
    if(count($menuItem)>1){
        echo"<img src=\"Images/$menuItem[1]\">";
    }
    echo $menuItem[0];
    echo '</a></li>';
    }
    private function showMenu(){
        echo '<div class="menu">   
        <ul>';  
    foreach($data['menu'] as $link => $menuItem) { 
        showMenuItem($link, $menuItem); 
    }
    echo ' 
        </ul>   
    </div>' . PHP_EOL;
    }
    protected function showContent(){
        echo '<section>';
    echo '<span class="error">'. getArrayVar($data, 'genericErr'). '</span>'; 
    switch($data['page'])
    {
        case 'home':
            require_once('home.php');
            showHomeContent();
            break;
        case 'about':
            require_once('about.php');
            showAboutContent();
            break;
        case 'contact':
            require_once('contact.php');
            showContactForm($data);
            break;
        case 'webshop':
            require_once('webshop.php');
            showWebshopContent($data);
            break;
        case 'shoppingCart':
            require_once('shoppingCart.php');
            showShoppingCartContent($data);
            break;
        case 'checkOutCart':
            require_once('shoppingCart.php');
            showCheckOutCartContent($data);
            break;
        case 'orders':
            require_once('orders.php');
            showOrdersContent($data);
            break;
        case 'orderDetail':
            require_once('orderDetail.php');
            showOrderDetailContent($data);
            break;
        case 'detail':
            require_once('productDetail.php');
            showProductDetailContent($data);
            break;
        case 'thanks':
            require_once('contact.php');
            showContactThanks($data);
            break;
        case 'register':
            require_once('register.php');
            showRegisterForm($data);
            break;
        case 'login':
            require_once('login.php');
            showLoginForm($data);
            break;
        case 'changepassword':
            require_once('passwordC.php');
            showChangePasswordForm($data);
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
    echo '</section>'; 
    }
    private function showPageNotFound(){
        echo '<div class="content">
        <p>PAGE NOT FOUND</p>
        </div>';
    }
    private function showFooter(){
        echo ' <footer>
        <p>&copy;</p>
        <p>2023-</p>
        <p>Omer Seker</p>
    </footer>';
    }
}


