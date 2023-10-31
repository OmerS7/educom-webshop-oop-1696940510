<?php

class modelFactory{

    public $crudFactory;
    private $lastModel = NULL;

    public function __construct($crudFactory) {
        $this->crudFactory = $crudFactory;
    } 


    public function createModel($type){
        $modelCrud = $this->crudFactory->createCrud($name);

        switch ($name) {
            case 'page':
                $this->lastModel = new PageModel($this->lastModel);
                break;
            case 'user':
                $this->lastModel = new UserModel($this->lastModel, $modelCrud);
                break;
            case 'shop':
                $this->lastModel = new ShopModel($this->lastModel, $modelCrud);
                break;
        }
        return $this->lastModel;
    }
    
}
