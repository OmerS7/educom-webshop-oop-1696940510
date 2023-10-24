<?php
require_once('basicDoc.php');

class loginDoc extends basicDoc{

    public $email = "";
    public $emailErr = "";
    public $password= "";
    public $passwordErr= "";

    protected function showHeader(){
        if(isset($_SESSION['email'])){
            $ingelogdeEmail = $_SESSION['email'];
            echo '<a href="logout.php">Logout</a>';
            echo "<span>$ingelogdeEmail!</span>"; 
        } else {
            echo '<h1>Login<h1>';
        }
    }

    protected function showContent() {
        echo '<form method="POST" action="index.php">
                  <label for="email">E-mailadres:</label>
                  <input type="text" id="email" name="email" value="'.$this->email.'">
                  <span class="error">* '.$this->emailErr.'</span><br><br>
      
                  <label for="password">Wachtwoord:</label>
                  <input type="password" id="password" name="password" value="'.$this->password.'">
                  <span class="error">* '.$this->passwordErr.'</span><br><br>
      
                  <div class="signInButton">
                      <input type="hidden" name="page" value="login">
                      <input type="submit" value="Sign In">
                  </div>
              </form>';
      } 
}