<?php
require_once('pageModel.php');

class userModel extends pageModel {
    //contactpage
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
    public $userId= 0;
    public $valid = false;
    public $success = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    public function validateContact(){    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->name = $this->getSavePostVar("name");
           
            if (empty($this->name)) { 
                $this->nameErr = "Voer een naam in"; 
            } 
    
            $this->email = $this->getSavePostVar("email");
            if (empty($this->email)) { 
                $this->emailErr = "Voer een emailadres in"; 
            } 
    
            $this->phone = $this->getSavePostVar("phone");
            if (empty($this->phone)) {
                $this->phoneErr = "Voer een telefoonnummer in";
            }
    
            $this->salutation = $this->getSavePostVar("salutation");
            if (empty($this->salutation)) {
                $this->salutationErr = "Aanhef verplicht";
            }
    
            $this->communication = $this->getSavePostVar("communication");
            if (empty($this->communication)) {
                $this->communicationErr = "Communicatie voorkeur is verplicht";
            }
    
            $this->comment = $this->getSavePostVar("comment");
            if (empty($this->comment)) {
                $this->commentErr = "Plaats een opmerking";
            }
            if (empty($this->nameErr) && empty($this->emailErr) && empty($this->phoneErr) && empty($this->salutationErr) && empty($this->communicationErr) && empty($this->commentErr)) {
                $this->valid =true;
            }
        }
    }

    function validateRegister() {
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $this->username = $this->getSavePostVar("name"); 
            if (empty($this->username)) {  
                $this->usernameErr = "Voer een naam in";  
            }  
        
            $this->email = $this->getSavePostVar("email"); 
            if (empty($this->email)) {  
                $this->emailErr = "Voer een emailadres in";  
            }  
        
            $this->password = $this->getSavePostVar("password"); 
            if (empty($this->password)) {  
                $this->passwordErr = "Voer geldig wachtwoord in";  
            }  
        
            $this->repeatpassword = $this->getSavePostVar("repeatpassword"); 
            if (empty($this->repeatpassword)) {  
                $this->repeatpasswordErr = "Herhaal het wachtwoord";  
            }  
        
            if ($this->password !== $this->repeatpassword) { 
                $this->repeatpasswordErr = "Wachtwoorden komen niet overeen"; 
            }

            if (empty($this->usernameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->repeatpasswordErr)) {
            
                try{ 
                    if (doesEmailExist($this->email)) {
                        $this->emailErr = "Email is al geregistreerd";
                    } else {
                        $this->valid = true;
                    }
                }
                catch(Exception $e){
                    $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
                    logerror("register failed: " . $e -> getMessage());
                }
            }
        }

    }

    function validateLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->email = $this->getSavePostVar("email");
                if (empty($this->email)) { 
                    $this->emailErr = "Voer een emailadres in"; 
                }
            $this->password = $this->getSavePostVar("password");
                if (empty($this->password)) { 
                    $this->passwordErr = "Voer geldig wachtwoord in"; 
                } 
    
            if (empty($this->emailErr) && empty($this->passwordErr)){
                try{
                    $this->user = authenticateUser($this->email, $this->password);
                    if (empty($this->user)) {
                        $this->emailErr = "Onbekend emailadres of onjuist wachtwoord";
                    } else {
                        $this->valid = true;
                        $this->username = $this->user['username'];
                        $this->userId = $this->user ['id'];
                    }
                }
                catch(Exception $e){
                    $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
                    logerror("logIn failed: " . $e -> getMessage());
                }
                
            } 
        }   
    }

    function validatePassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $password = $this->getSavePostVar("password"); 
            if (empty($password)) {  
                $passwordErr = "Voer je huidige wachtwoord in";  
            }

            $changepassword = $this->getSavePostVar("changepassword");
            if (empty($changepassword)){
                $changepasswordErr = "Voer een nieuw wachtwoord in";
            }

            $repeatchangepassword = $this->getSavePostVar("repeatchangepassword");
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
                    $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
                    logerror("changepassword failed: " . $e -> getMessage());
                }
            }
        }
    }

    function authenticateUser(){
        require_once('db_repostitory.php');
        $this->user = findUserByEmail($this->email);
            if (empty($this->user)){
                return null;
            }
            if ($this->user["password"]!=$this->password){
                return null;
            }
        return $this->user;   
    }

    public function doLoginUser(){
        $this->sessionManager->doLoginUser($this->name, $this->userId);
        $this->genericErr="Login succesvol";
    }

    public function doLogoutUser(){
        $this->sessionManager->doLogoutUser;
    }

}