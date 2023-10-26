<?php
require_once('basicDoc.php');
class passwordCDoc extends basicDoc{

    public $password = "";
    public $changepassword = "";
    public $repeatchangepassword = ""; 
    public $passwordErr = "";
    public $changepasswordErr = "";
    public $repeatchangepasswordErr = "";
    public $genericErr = "";
    public $userId = 0; 
    public $valid = false; 
    public $email="";


    protected function showHeader() {
        echo 'Wachtwoord Wijzigen';
    }

    protected function showContent(){
        echo '<form method="POST" action="index.php">

            <div class="passwordChange">
                <label for="password">Huidige wachtwoord:</label>
                <input type="password" id ="password" name="password" value="'. $this->password.'">
                <span class="error">* '.$this->model->passwordErr.'</span><br><br>
            </div>
            <div class="passwordChangeS">
                <label for="changepassword">Nieuw wachtwoord:</label>
                <input type="password" name="changepassword" value="'.$this->changepassword.'">
                <span class="error">* '.$this->model->changepasswordErr.'</span><br><br>
            </div>
            <div class="repeatpasswordS">
                <label for="repeatchangepassword">Herhaal nieuw wachtwoord:</label>
                <input type="password" name="repeatchangepassword" value="'.$this->repeatchangepassword.'">
                <span class="error">* '.$this->model->repeatchangepasswordErr.'</span><br><br>
            </div>

            <div class="changePasswordButton">
                <input type="hidden" name="page" value="changepassword">
                <input type="submit" value="Wijzig">
            </div>
    </form>';
    }
}    