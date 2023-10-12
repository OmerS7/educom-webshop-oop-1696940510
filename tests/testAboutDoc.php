<?php
require_once ('../views/AboutDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']]];
$view=new AboutDoc($data);
$view-> show();


