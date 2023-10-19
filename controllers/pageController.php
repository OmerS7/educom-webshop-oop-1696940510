<?php
require_once('../views/userModel.php');
require_once('../views/shopModel.php');

class pageController{

    private $model;

    public function __construct() {
        $this->model = new PageModel(NULL);
    }

  
