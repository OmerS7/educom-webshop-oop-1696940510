<?php
require_once('basicDoc.php');
class RegisterDoc extends basicDoc{

    public $name = "";
    public $username= "";
    public $usernameErr= "";
    public $password= "";
    public $passwordErr= "";
    public $repeatpassword= "";
    public $repeatpasswordErr= "";
    public $email = "";
    public $phone = "";
    public $salutation = "";
    public $communication = "";
    public $comment = "";
    public $nameErr = "";
    public $emailErr = "";
    public $phoneErr = "";
    public $salutationErr = "";
    public $communicationErr = "";
    public $commentErr = "";
    public $genericErr = "";
    public $valid = false;
    public $success = false;

   protected function showHeader(){
        echo 'Nu registeren';
   }  

   protected function showContent(){
    //$username = $this->data['username'];
  
    echo '<form method="POST" action="index.php">

        <div class="naamStyling2">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="'.$this->username.'">
            <span class="error">* '.$this->model->usernameErr.'</span><br><br>
        </div>
        <div class="emailStyling2">
            <label for="email">E-mailadres:</label>
            <input type="text" id="email" name="email" value="'.$this->email.'">
            <span class="error">* '.$this->model->emailErr.'</span><br><br>
        </div>
        <div class="passwordSt">
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" value="'.$this->password.'">
            <span class="error">* '.$this->model->passwordErr.'</span><br><br>
        </div>    
        <div class="repeatpasswordSt">
            <label for="repeatpassword">Herhaal wachtwoord:</label>
            <input type="password" id="repeatpassword" name="repeatpassword" value="'.$this->repeatpassword.'">
            <span class="error">* '.$this->model->repeatpasswordErr.'</span><br><br>
        </div>
            <div class="signUpButton">
            <input type="hidden" name="page" value="register">
                <input type="submit" value="Sign Up">
            </div>
        </form>';
   }
}