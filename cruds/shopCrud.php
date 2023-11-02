<?php

class shopCrud{

    private $crud;

    public function __construct($crud){
        $this->crud = $crud;
    }

    public function getAllProducts(){
        $sql="SELECT * FROM products";
        $params= [];
        return $this->crud->readManyRows($sql, $params);
    }

    public function getProductById($id){
        $sql="SELECT * FROM products WHERE id = :id";
        $params = ['id' => $id];
        return $this->crud->readOneRow($sql, $params);
    }

    public function saveCheckOutCart($userId, $cart){
        $sql = "INSERT INTO orders(userid, orderdate, ordernumber)
                VALUES (:userId, NOW(), CONCAT(YEAR(NOW()), '000000'))";
        $params = ['userId' => $userId];
        $orderId = $this->crud->createRow($sql, $params);
    
        $maxOrderNumber = $this->getMaxOrderNumber();
    
        $sql = "UPDATE orders SET ordernumber = :orderNumber WHERE id = :orderId";
        $params = ['orderNumber' => $maxOrderNumber + 1, 'orderId' => $orderId];
        $this->crud->updateRow($sql, $params);
    
        foreach($cart as $productId => $amount){
            $sql = "INSERT INTO productline(orderid, productid, amount)
                    VALUES (:orderId, :productId, :amount)";
            $params = ['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount];
            $this->crud->createRow($sql, $params);
        }
    }
    
    private function getMaxOrderNumber() {
        $sql = "SELECT MAX(ordernumber) AS maxordernumber FROM orders";
        $result = $this->crud->readOneRow($sql);
        return $result->maxordernumber;
    }

    public function getAllOrders($userId){
        $sql = "SELECT o.id, o.orderDate, o.orderNumber, SUM(pl.amount * p.price) AS 'total'
                FROM orders AS o
                JOIN productline AS pl ON pl.orderid = o.id
                JOIN products AS p ON p.productId = pl.productId
                WHERE o.userId = :userId
                GROUP BY o.id";
        $params = ['userId' => $userId];
        return $this->crud->readManyRows($sql, $params);
    }

    function getOrderById($id, $userId){
        $sql="SELECT o.id, o.orderDate, o.orderNumber, pl.amount, p.productId, p.productname, p.description, p.price, p.productimage 
        FROM orders AS o
        JOIN productline AS pl ON pl.orderid = o.id
        JOIN products AS p ON p.productId = pl.productId
        WHERE o.id = $id AND o.userId = $userId";
        $params = ['id' => $id, 'userId' => $userId];
        return $this->crud->readManyRows($sql, $params);
    }
}