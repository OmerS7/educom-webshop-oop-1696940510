<?php
require_once('basicDoc.php');

abstract class formDoc extends basicDoc{
    abstract public function showform();
    abstract public function validateForm();
}