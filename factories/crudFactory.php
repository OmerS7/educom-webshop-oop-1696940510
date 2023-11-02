<?php
require_once('cruds/usercrud.php');
require_once('cruds/shopcrud.php');

class CrudFactory {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function createCrud($name) {
        switch($name) {
            case 'user':
                return new UserCrud($this->crud);
                break;
            case 'shop':
                return new ShopCrud($this->crud);
                break;
        }
    }
}

?>