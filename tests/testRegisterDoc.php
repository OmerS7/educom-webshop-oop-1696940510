<?php
require_once('../views/registerDoc.php');

$data = [ 'menu' => [ 'pagina1' => ['pagina 1'], 
                      'pagina2' => ['pag 2', 'cartPlus.svg']],
            'salutation' => 'madam', 
            'salutationErr' => 'the salutation error',
            'name' => 'Omer',
            'nameErr' => "De naam error",
            'username' => 'Po',
            'usernameErr' => 'username error',
            'email' => 'po@hotmail.com',
            'emailErr'=> 'email error',
            'password'=> 'sss',
            'passwordErr' => 'password error',
            'repeatpassword' => 'repeatpassword error',
            'repeatpasswordErr'=> 'reae'
            ];
$view=new RegisterDoc($data);
$view-> show();
