<?php
require_once('cruds/usercrud.php');
require_once('cruds/shopcrud.php');
require_once('cruds/ratingCrud.php');

class CrudFactory {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function createCrud($name) {
        
        switch($name) {
            case 'user':
                return new UserCrud($this->crud);
            case 'shop':
                return new ShopCrud($this->crud);
            case 'rating':
                return new ratingCrud($this->crud);
        }
    }
}

?>