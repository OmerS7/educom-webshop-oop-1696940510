<?php
require_once('basicDoc.php');

class loginDoc extends basicDoc{

    protected function showHeader(){
        if(isset($_SESSION['email'])){
            $ingelogdeEmail = $_SESSION['email'];
            echo '<a href="logout.php">Logout</a>';
            echo "<span>$ingelogdeEmail!</span>"; 
        } else {
            echo 'Login';
        }
    }

    protected function showContent() {
        echo '<form method="POST" action="index.php">
                  <label for="email">E-mailadres:</label>
                  <input type="text" id="email" name="email" value="'.$this->model->email.'">
                  <span class="error">* '.$this->model->emailErr.'</span><br><br>
      
                  <label for="password">Wachtwoord:</label>
                  <input type="password" id="password" name="password" value="'.$this->model->password.'">
                  <span class="error">* '.$this->model->passwordErr.'</span><br><br>
      
                  <div class="signInButton">
                      <input type="hidden" name="page" value="login">
                      <input type="submit" value="Sign In">
                  </div>
              </form>';
      } 
}