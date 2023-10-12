<?php

require_once 'utils.php';
require_once 'user_service.php';

function showChangePasswordHeader() {
    echo 'Wachtwoord Wijzigen';
}

function validatePassword() {
        $password = "";
        $changepassword = $repeatchangepassword = ""; 
        $passwordErr = "";
        $changepasswordErr = $repeatchangepasswordErr = "";
        $genericErr = "";
        $userId = 0; 
        $valid = false; 
        $email="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $password = testInput(getPostVar("password")); 
        if (empty($password)) {  
            $passwordErr = "Voer je huidige wachtwoord in";  
        }

        $changepassword = testInput (getPostVar("changepassword"));
        if (empty($changepassword)){
            $changepasswordErr = "Voer een nieuw wachtwoord in";
        }

        $repeatchangepassword = testInput (getPostVar("repeatchangepassword"));
        if (empty($repeatchangepassword)){
            $repeatchangepasswordErr = "Herhaal het nieuwe wachtwoord";
        }

        if($changepassword !== $repeatchangepassword){
            $repeatchangepasswordErr = "Herhaal wachtwoord komt niet overeen";
        }
        
        if (empty($passwordErr) && empty($changepasswordErr) && empty($repeatchangepasswordErr)) {
            try{
                $userId = getLoggedInUserId();   
                $userpassword = authenticateUserPassword($userId,$password); 
                if (empty($userpassword)) {
                    $passwordErr = "Wachtwoord is ongeldig";
                } else {
                    $valid = true;
                    $email = $userpassword['email'];
                }
            }
            catch(Exception $e){
                $genericErr = "Er is een technische storing. Probeer het later nog eens";
                logerror("changepassword failed: " . $e -> getMessage());
            }
        }
    }
    return array( 
    'valid' => $valid,
    'password' => $password,
    'changepassword' => $changepassword,
    'repeatchangepassword' => $repeatchangepassword,
    'passwordErr' => $passwordErr,
    'changepasswordErr' => $changepasswordErr,
    'repeatchangepasswordErr' => $repeatchangepasswordErr,
    'genericErr' => $genericErr,
    'userId' => $userId,
    'email' => $email
    );        
}

function showChangePasswordForm($data) {
  echo '<form method="POST" action="index.php">
            <label for="password">Huidige wachtwoord:</label>
            <input type="password" id ="password" name="password" value="'. $data ["password"].'">
            <span class="error">* '.$data['passwordErr'].'</span><br><br>

            <label for="changepassword">Nieuw wachtwoord:</label>
            <input type="password" name="changepassword" value="'.$data["changepassword"].'">
            <span class="error">* '.$data['changepasswordErr'].'</span><br><br>

            <label for="repeatchangepassword">Herhaal nieuw wachtwoord:</label>
            <input type="password" name="repeatchangepassword" value="'.$data["repeatchangepassword"].'">
            <span class="error">* '.$data['repeatchangepasswordErr'].'</span><br><br>

            <div class="changePasswordButton">
                <input type="hidden" name="page" value="changepassword">
                <input type="submit" value="Wijzig">
            </div>
        </form>';
} 