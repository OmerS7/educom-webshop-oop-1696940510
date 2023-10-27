<?php

class menuItem {
    public $name;
    public $label;
    public $icon;
    public $userName;

    public function __construct($name, $label, $icon = NULL, $userName = NULL) {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->userName = $userName;
    }
}



