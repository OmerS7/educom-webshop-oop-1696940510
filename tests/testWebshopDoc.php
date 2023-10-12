<?php
require_once ('../views/webshopDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
            'salutation' => 'madam', 
            'salutationErr' => 'the salutation error',
            'name' => 'Omer',
            'nameErr' => "De naam error", 
            ];
        
$view=new webshopDoc($data);
$view-> show();

