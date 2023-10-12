<?php
require_once ('../views/basicDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']]];
$view=new BasicDoc($data);
$view-> show();





