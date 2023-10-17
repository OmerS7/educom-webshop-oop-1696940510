<?php
require_once ('../views/ordersDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
            'succes' => true, 
            'orders' => [
                ['id' => 3, 'orderDate' => '17-10-2023', 'orderNumber' => 'c2300008', 'total' => 14.95],
                ['id' => 2, 'orderDate' => '18-10-2023', 'orderNumber' => 'c2300009', 'total' => 24.95]
            ]
        ];
        
$view=new ordersDoc($data);
$view-> show();
