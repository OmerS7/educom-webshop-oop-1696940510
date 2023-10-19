<?php
require_once('../views/passwordCDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
                      'password'=>'jo',
                      'passwordErr'=>'errormelding',
                      'changepassword'=>'jo',
                      'changepasswordErr'=>'errormelding',
                      'repeatchangepassword'=>'jo',
                      'repeatchangepasswordErr'=>'erromelding'


];
$view=new passwordCDoc($data);
$view-> show();