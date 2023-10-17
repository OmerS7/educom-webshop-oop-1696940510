<?php
require_once('basicDoc.php');
class RegisterDoc extends basicDoc{
   protected function showHeader(){
        echo 'Nu registeren';
   }  

   protected function showContent(){
    //$username = $this->data['username'];
  
    echo '<form method="POST" action="index.php">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="'.$this->data["username"].'">
        <span class="error">* '.$this->data["usernameErr"].'</span><br><br>

        <label for="email">E-mailadres:</label>
        <input type="text" id="email" name="email" value="'.$this->data["email"].'">
        <span class="error">* '.$this->data["emailErr"].'</span><br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" value="'.$this->data["password"].'">
        <span class="error">* '.$this->data["passwordErr"].'</span><br><br>

        <label for="repeatpassword">Herhaal wachtwoord:</label>
        <input type="password" id="repeatpassword" name="repeatpassword" value="'.$this->data["repeatpassword"].'">
        <span class="error1">* '.$this->data["repeatpasswordErr"].'</span><br><br>

        <div class="signUpButton">
        <input type="hidden" name="page" value="register">
            <input type="submit" value="Sign Up">
        </div>
        </form>';
   }
}