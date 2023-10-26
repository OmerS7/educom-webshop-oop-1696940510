<?php
require_once('basicDoc.php');
class thanksDoc extends basicDoc{

    protected function showHeader(){
        echo 'Contact';
    }

    protected function showContent() {
        echo '<p class="thankYou"> Bedankt voor uw reactie! </p>';
        echo '<p class="yourInfo"> Uw ingevoerde gegegens: </p>';
        echo '<li> Naam: ' . $this->model->name . '<br>';
        echo '<li> Telefoonnummer: ' . $this->model->phone . '<br>';
        echo '<li> E-mail: ' . $this->model->email . '<br>';
        echo '<li> Communicatie voorkeur: ' . $this->model->communication . '<br>';
        echo '<li class="bottomText"> Bericht: ' . $this->model->comment . '<br>';
    }
}
