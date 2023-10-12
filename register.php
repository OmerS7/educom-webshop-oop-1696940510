<?php

require_once 'utils.php'; 
require_once 'user_service.php';

function showRegisterHeader() {
    echo 'Nu registreren';
}

function validateRegister() {
        $username = $email = $password = $repeatpassword = ""; 
        $usernameErr = $emailErr = $passwordErr = $repeatpasswordErr = $genericErr = ""; 
        $valid = false; 
    
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $username = testInput(getPostVar("name")); 
        if (empty($username)) {  
            $usernameErr = "Voer een naam in";  
        }  
    
        $email = testInput(getPostVar("email")); 
        if (empty($email)) {  
            $emailErr = "Voer een emailadres in";  
        }  
    
        $password = testInput(getPostVar("password")); 
        if (empty($password)) {  
            $passwordErr = "Voer geldig wachtwoord in";  
        }  
    
        $repeatpassword = testInput(getPostVar("repeatpassword")); 
        if (empty($repeatpassword)) {  
            $repeatpasswordErr = "Herhaal het wachtwoord";  
        }  
    
        if ($password !== $repeatpassword) { 
            $repeatpasswordErr = "Wachtwoorden komen niet overeen"; 
        }

        if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr)) {
        
            try{ 
                if (doesEmailExist($email)) {
                    $emailErr = "Email is al geregistreerd";
                } else {
                    $valid = true;
                }
            }
            catch(Exception $e){
                $genericErr = "Er is een technische storing. Probeer het later nog eens";
                logerror("register failed: " . $e -> getMessage());
            }
        }
    }

    return array(
        'valid' => $valid,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'repeatpassword' => $repeatpassword,
        'usernameErr' => $usernameErr,
        'emailErr' => $emailErr,
        'passwordErr' => $passwordErr,
        'repeatpasswordErr' => $repeatpasswordErr,
        'genericErr' => $genericErr
    );
}
 
/*
function showRegisterContent() {
        $data = validateRegister();
        if ($data['valid']) {
           saveUser($data['email'], $data['username'], $data['password']);
           echo "Registration successfull";
        } else {
           showRegisterForm($data);
        } 
    }
*/

function showRegisterForm($data) {

    echo '<form method="POST" action="index.php">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="'.$data["username"].'">
        <span class="error">* '.$data["usernameErr"].'</span><br><br>

        <label for="email">E-mailadres:</label>
        <input type="text" id="email" name="email" value="'.$data["email"].'">
        <span class="error">* '.$data["emailErr"].'</span><br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" value="'.$data["password"].'">
        <span class="error">* '.$data["passwordErr"].'</span><br><br>

        <label for="repeatpassword">Herhaal wachtwoord:</label>
        <input type="password" id="repeatpassword" name="repeatpassword" value="'.$data["repeatpassword"].'">
        <span class="error1">* '.$data["repeatpasswordErr"].'</span><br><br>

        <div class="signUpButton">
        <input type="hidden" name="page" value="register">
            <input type="submit" value="Sign Up">
        </div>
        </form>';
    } 
?>
