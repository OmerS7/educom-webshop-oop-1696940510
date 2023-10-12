<?php

require_once("session_manager.php");
require_once("utils.php");

$page = getRequestedPage();
$data= processRequest($page);
showResponsePage($data);

function getRequestedPage()
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST' )
    {
        $requested_page = getPostVar('page','home');
    }
    else
    {
        $requested_page = getUrlVar('page','home');
    }
    return $requested_page;
} 

function processRequest($page){ 
    switch($page){
        case "login":
            require_once('login.php');
            $data = validateLogin();
            if ($data['valid']){
                doLoginUser($data['username'], $data['userId']);
                $page = "home";
            }
            break;   
        case "contact":
            require_once('contact.php');
            $data = validateContact();
            if($data['valid']){
                $data = doStoreContact($data);
                if ($data['succes']) {
                    $page = "thanks";
                }
            }    
            break;      
        case "logout":
            require_once('logout.php');
            doLogoutUser();
            $page = "home";
            break;
        case "changepassword":
            require_once('passwordC.php');
            $data = validatePassword();
            if ($data['valid']){
                $data = doChangePassword($data);
                if ($data['succes']) {
                    $page = "login";
                    $data['emailErr'] = "";
                    $data['password'] = "";
                }
            }    
            break;
        case "register":
            require_once('register.php');
            $data = validateRegister();
            if($data['valid']){
                $data = doRegisterUser($data);
                if ($data['succes']){
                    $page = "home";
                }
            }
            break;
        case "webshop":
            require_once('webshop.php');
            handleAction();
            $data = doRetreiveProducts();
            break;
        case "detail":
            require_once('productDetail.php');
            $data = doRetreiveProductId();
            break;
        case "shoppingCart":
            require_once('webshop.php');
            $data = handleAction();
            $data = array_merge($data,doRetreiveShoppingCart());
            break;
        case "orders":
            require_once('orders.php');
            $data = doRetreiveOrders();
            break;
        case "orderDetail":
            require_once('orderDetail.php');
            $data = doRetreiveOrderId();
            break;
    }  
    $data['page'] = $page;
    
    $data['menu'] = array('home' => ['HOME'], 'about' => ['ABOUT'], 'contact' => ['CONTACT'], 'webshop' => ['','NikeLogoWhite.png']);
    if (isUserLoggedIn()) {
        $data['menu']['shoppingCart'] = ["","cart.svg"]; 
        $data['menu']['orders'] = ["","cartorders.svg"];
        $data['menu']['changepassword'] = ["","lock.svg"];
        $data['menu']['logout'] = ["" . getLoggedInUser(),"logout.svg"];
    } else {
        $data['menu']['register'] = ["REGISTER"];
        $data['menu']['login'] = ["LOGIN"];
    }
    return $data;
}


function doStoreContact($data) {
    $data['succes'] = false;
    try{
        storeContact($data['name'], $data['phone'], $data['email'], $data['salutation'], $data['communication'], $data['comment']);
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("registration failed: " . $e -> getMessage());
    }
    return $data;
}

function doRegisterUser($data) {
    $data['succes'] = false;
    try{
        storeUser($data['email'], $data['username'], $data['password']);
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Registraation failed: " . $e -> getMessage());
    }
    return $data;
}

function doChangePassword($data){
    $data['succes'] = false;
    try{
        storeChangePassword($data['userId'], $data['changepassword']);
        $data['succes'] = true;
        doLogoutUser(); 
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Registraation failed: " . $e -> getMessage());
    }
    return $data;
}

function doRetreiveProducts(){
    $data = array();
    $data['succes'] = false;
    try{
        require_once 'productService.php';
        $data['products'] = getProducts();
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Product retreiving failed: " . $e -> getMessage());
    }
    return $data;
}

function doRetreiveProductId(){
    $data = array();
    $data['succes'] = false;
    try{
        require_once 'productService.php';
        $productId = getUrlVar('id');
        $data['product'] = getProduct($productId);
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Product retreiving failed: " . $e -> getMessage());
    }
    return $data;
}

function doRetreiveShoppingCart(){
    $data = array();
    $data['succes'] = false;
    try{
        require_once 'productService.php';
        $products = getProducts();
        $cart = getCart();
        $totalPrice = 0;
        $data['cartLines'] = array();
        foreach($cart as $productId => $amount){
            $product = $products[$productId];
            $subTotal = $product['price'] * $amount;
            $totalPrice += $subTotal;
            $data['cartLines'][] = array("productId" => $productId, "amount" => $amount,
                                         "subTotal" => $subTotal, "name" => $product["productname"], 
                                         "image" => $product["productimage"], "price" => $product["price"]); 
        }
        $data["totalPrice"] = $totalPrice;
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Product retreiving failed: " . $e -> getMessage());
    }
    return $data;
}

function doRetreiveOrders(){
    $data = array();
    $data['succes'] = false;
    try{
        require_once 'productService.php';
        $data['orders'] = getOrders();
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Order retreiving failed: " . $e -> getMessage());
    }
    return $data;
}

function doRetreiveOrderId(){
    $data = array();
    $data['succes'] = false;
    try{
        require_once 'productService.php';
        $id = getOrderById('id');
        $data['orders'] = getOrder($id);
        $data['succes'] = true;
    }
    catch(Exception $e){
        $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
        logerror("Order retreiving failed: " . $e -> getMessage());
    }
    return $data;
}

function showResponsePage ($data)
{
    beginDocument();
    showHeadSection();
    showBodySection($data);
    endDocument();
}

function getArrayVar($array, $key, $default='')
{
    return isset ($array[$key]) ? $array[$key] : $default;
}

function getPostVar($key,$default='')
{
    return getArrayVar($_POST, $key, $default);
}

function getUrlVar($key,$default='')
{
    return getArrayVar($_GET, $key, $default);
}

function beginDocument()
{
    echo '<!doctype html>'.PHP_EOL.'<html>'.PHP_EOL;
}

function showHeadSection()
{
    echo '  <head>' . PHP_EOL;
    echo '    <link rel="stylesheet"  href="CSS/stylesheet.css">' . PHP_EOL;
    echo '  </head>' . PHP_EOL;
}

function showBodySection($data)
{
    echo '  <body>' . PHP_EOL;
    showHeader($data['page']);
    showMenu($data);
    showContent($data);
    showFooter();
    echo '  </body>' .PHP_EOL;
}

function endDocument()
{
    echo '</html>';
}

function showHeader($page)
{
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

function showMenuItem($page, $menuItem)
{
    echo '<li><a href="index.php?page=' . $page . '">';
    if(count($menuItem)>1){
        echo"<img src=\"Images/$menuItem[1]\">";
    }
    echo $menuItem[0];
    echo '</a></li>';
}


function showMenu($data) {  
    echo '<div class="menu">   
        <ul>';  
    foreach($data['menu'] as $link => $menuItem) { 
        showMenuItem($link, $menuItem); 
    }
    echo ' 
        </ul>   
    </div>' . PHP_EOL;  
}

function showContent($data)
{
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

function showPageNotFound(){
    echo '<div class="content">
    <p>PAGE NOT FOUND</p>
    </div>';
}

function showFooter()
{
    echo ' <footer>
    <p>&copy;</p>
    <p>2023-</p>
    <p>Omer Seker</p>
</footer>';
}

?>