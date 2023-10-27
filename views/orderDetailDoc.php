<?php
require_once('views/ordersDoc');
class orderDetailDoc extends ordersDoc{


    function showOrderDetailHeader(){
        echo 'Overzicht orders';
    }

    function showOrderDetailContent() {
        //$orders = getArrayVar($data, 'orders', NULL);
        if (isset($this->model->succes) && $this->model->succes) {        
            $orders = $this->model->orders; 
            foreach ($orders as $order) {
                echo '<div class="orderOverzicht">';
                echo '<img src="Images/' . $order['productimage'] . '" alt="' . $order['productname'] . '">';
                echo "&euro;{$order['price']}<br>";
                echo "{$order['productname']}<br>";
                echo "{$order['description']}";
                echo "</div>"; 
            }
        }
    }   
}