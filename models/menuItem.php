<?php

class menuItem {
    public $name;
    public $label;
    public $icon;

    public function __construct($name, $label, $icon = null) {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
    }
}



