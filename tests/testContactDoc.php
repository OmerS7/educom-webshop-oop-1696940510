<?php
require_once ('../views/ContactDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
            'salutation' => 'madam', 
            'salutationErr' => 'the salutation error',
            'name' => 'Omer',
            'nameErr' => "De naam error",
            'productimage' 
            ];
$view=new ContactDoc($data);
$view-> show();



