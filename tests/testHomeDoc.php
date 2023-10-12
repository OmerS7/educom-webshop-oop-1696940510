<?php
require_once ('../views/HomeDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']]];
$view=new HomeDoc($data);
$view-> show();





