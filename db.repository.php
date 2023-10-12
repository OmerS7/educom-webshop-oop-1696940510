<?php
function connectDatabase(){
    $server = "localhost";
    $username = "omer_web_shop_user";
    $password = "educom123!";
    $database = "omer_webshop";

    $conn = mysqli_connect($server, $username, $password, $database);
        if (!$conn) {
            die ("Connection failed: " . mysqli_connect_error());
        }
    return $conn;
    }

function findUserByEmail($email){
    $conn = connectDatabase();
    try{
        $email = mysqli_real_escape_string($conn, $email);
        $sql ="SELECT * FROM users WHERE email ='$email'";
        $result = mysqli_query($conn, $sql);

        $user= mysqli_fetch_assoc($result);
        return $user;   
    } finally{
        mysqli_close($conn);
    }
}

function saveUser($email,$username,$password){
    $conn = connectDatabase();
    try{
        $email = mysqli_real_escape_string($conn, $email);
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $sql ="INSERT INTO users (username, email, `password`)
        VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save user failed, sql:$sql,error: " . mysqli_error($conn));
        }
    } finally {
        mysqli_close($conn);
    } 
}

function saveContact($name,$phone,$email,$salutation,$communication,$comment){
    $conn = connectDatabase();
    try{
        $email = mysqli_real_escape_string($conn, $email);
        $name = mysqli_real_escape_string($conn, $name);
        $phone = mysqli_real_escape_string($conn, $phone);
        $salutation = mysqli_real_escape_string($conn, $salutation);
        $communication = mysqli_real_escape_string($conn, $communication);
        $comment = mysqli_real_escape_string($conn, $comment);
        $sql ="INSERT INTO contact(`name`, phone, email, salutation, communication, comment)
        VALUES ('$name', '$phone', '$email', '$salutation', '$communication', '$comment')";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save contact failed, sql:$sql,error: " . mysqli_error($conn));
        }
    } finally {
        mysqli_close($conn);
    }
}

function findUserById($userId){
    $conn = connectDatabase();
    try{
        $userId = mysqli_real_escape_string($conn, $userId);
        $sql ="SELECT * FROM users WHERE `id` ='$userId'";
        $result = mysqli_query($conn, $sql);

        $userpassword= mysqli_fetch_assoc($result);
        return $userpassword;   
    } finally{
        mysqli_close($conn);
    }
}



/// wachtwoord wijzigen functie
function saveChangePassword($id,$password){
    $conn = connectDatabase();
    try{
        $id = mysqli_real_escape_string($conn, $id);
        $password = mysqli_real_escape_string($conn, $password);
        $sql ="UPDATE users SET `password` ='$password' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save password failed, sql:$sql,error: " . mysqli_error($conn));
        }
    } finally {
        mysqli_close($conn);
    } 
}

function getAllProducts(){
    $conn = connectDatabase();
    try{
        $products = array();
        $sql="SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $products[$row['productId']] = $row;
        }
        return $products;
    } finally{
        mysqli_close($conn);
    }
} 

function getProductById($id){
    $conn = connectDatabase();
    try{
        $id = mysqli_real_escape_string($conn, $id);
        $sql="SELECT * FROM products WHERE productId = $id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    } finally{
        mysqli_close($conn);
    }
}

function saveCheckOutCart($userId,$cart){
    $conn = connectDatabase();
    try{
        // step 1: insert a new order
        $userId = mysqli_real_escape_string($conn, $userId);
        $sql="INSERT INTO orders(userid,orderdate,ordernumber)
              VALUES ('$userId', NOW(), CONCAT (YEAR(NOW()),'000000'))";

        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save checkout failed, sql:$sql,error: " . mysqli_error($conn));
        }
        $orderId = mysqli_insert_id($conn);
        // step2: find highest ordernumber
        $sql="SELECT MAX(ordernumber) AS maxordernumber FROM orders";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save checkout failed, sql:$sql,error: " . mysqli_error($conn));
        }
        $orderNumber = mysqli_fetch_assoc($result);
        $maxOrderNumber = $orderNumber['maxordernumber'];
        // step 3: update record from step 1 to update the ordernumber to be maxordernumber + 1
        $sql="UPDATE orders SET ordernumber= $maxOrderNumber +1 WHERE id= '$orderId'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            throw new Exception("save checkout failed, sql:$sql,error: " . mysqli_error($conn));
        }

        foreach($cart as $productId => $amount){
            $sql="INSERT INTO productline(orderid, productid, amount)
                  VALUES ($orderId, $productId, $amount)"; 
            $result = mysqli_query($conn, $sql);
            if(!$result){
                throw new Exception("save checkout failed, sql:$sql,error: " . mysqli_error($conn));
            }
        }
    } finally {
        mysqli_close($conn);
    } 
}

function getAllOrders(){
    $conn = connectDatabase();
    try{
        $orders = array();
        $sql="SELECT o.id, o.orderDate, o.orderNumber, SUM(pl.amount * p.price) AS 'total'
        FROM orders AS o
        JOIN productline AS pl ON pl.orderid = o.id
        JOIN products AS p ON p.productId = pl.productId
        GROUP BY o.id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $orders[$row['id']] = $row;
        }
        return $orders;
    } finally{
        mysqli_close($conn);
    }
}

function getOrderById($id){
    $conn = connectDatabase();
    try{
        $sql="SELECT o.id, o.orderDate, o.orderNumber, pl.amount, p.productId, p.productname, p.description, p.price, p.productimage 
        FROM orders AS o
        JOIN productline AS pl ON pl.orderid = o.id
        JOIN products AS p ON p.productId = pl.productId";
        $result = mysqli_query($conn, $sql);
        $orders = array(); // Maak een array om de orders op te slaan

        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row; // Voeg elke rij toe aan de array
        }
        return $orders;
    } finally{
        mysqli_close($conn);
    }
}


