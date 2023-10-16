<?php
require_once ('../views/ordersDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
            'succes' => true, 
            'products' => [
                ['productId' => 3, 'productname' => 'nikeair', 'productimage' => 'cartPLus.svg', 'price' => 14.95],
                ['productId' => 2, 'productname' => 'Jordan', 'productimage' => 'cartPLus.svg', 'price' => 24.95]
            ]
        ];
        
$view=new ordersDoc($data);
$view-> show();
