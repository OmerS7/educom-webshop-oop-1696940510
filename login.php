<?php

require_once 'utils.php';
require_once 'user_service.php';

function showLoginHeader(){
    if(isset($_SESSION['email'])){
        $ingelogdeEmail = $_SESSION['email'];
        echo '<a href="logout.php">Logout</a>';
        echo "<span>$ingelogdeEmail!</span>"; 
    } else {
        echo '<h1>Login<h1>';
    }
}

function validateLogin() {
    $email = $password = "";
    $emailErr = $passwordErr = "";
    $username = "";
    $userId = 0;
    $genericErr= "";
    $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = testInput(getPostVar("email"));
            if (empty($email)) { 
                $emailErr = "Voer een emailadres in"; 
            }
        $password = testInput(getPostVar("password"));
            if (empty($password)) { 
                $passwordErr = "Voer geldig wachtwoord in"; 
            } 

        if (empty($emailErr) && empty($passwordErr)){
            try{
                $user = authenticateUser($email, $password);
                if (empty($user)) {
                    $emailErr = "Onbekend emailadres of onjuist wachtwoord";
                } else {
                    $valid = true;
                    $username = $user['username'];
                    $userId = $user ['id'];
                }
            }
            catch(Exception $e){
                $genericErr = "Er is een technische storing. Probeer het later nog eens";
                logerror("logIn failed: " . $e -> getMessage());
            }
            
        } 
    }   
    return array('email' => $email, 'emailErr' => $emailErr, 'password' => $password, 
                 'passwordErr' => $passwordErr, 'valid' => $valid, 'username' => $username, 'genericErr' => $genericErr, 'userId' => $userId); 
}

function showLoginForm($data) {
  echo '<form method="POST" action="index.php">
            <label for="email">E-mailadres:</label>
            <input type="text" id="email" name="email" value="'.$data['email'].'">
            <span class="error">* '.$data['emailErr'].'</span><br><br>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" value="'.$data['password'].'">
            <span class="error">* '.$data['passwordErr'].'</span><br><br>

            <div class="signInButton">
                <input type="hidden" name="page" value="login">
                <input type="submit" value="Sign In">
            </div>
        </form>';
} 
?>