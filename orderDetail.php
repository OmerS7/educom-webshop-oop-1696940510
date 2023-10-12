<?php

function showOrderDetailHeader(){
    echo 'Overzicht orders';
}

function showOrderDetailContent($data) {
    //$orders = getArrayVar($data, 'orders', NULL);
    if (isset($data['succes']) && $data['succes']) {        
        $orders = $data['orders']; 
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