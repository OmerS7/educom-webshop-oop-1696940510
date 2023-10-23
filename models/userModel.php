<?php
require_once('pageModel.php');

class userModel extends pageModel{

    public function __construct($pageModel){
        PARENT::__construct($pageModel);
    }

    public function validateContact(){    
        $this->name = $this->email = $this->phone = $this->salutation = $this->communication = $this->comment = "";
        $this->nameErr = $this->emailErr = $this->phoneErr = $this->salutationErr = $this->communicationErr = $this->commentErr = "";
        $valid = false;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->name = testInput(getPostVar("name"));
            if (empty($this->name)) { 
                $this->nameErr = "Voer een naam in"; 
            } 
    
            $this->email = testInput(getPostVar("email"));
            if (empty($this->email)) { 
                $this->emailErr = "Voer een emailadres in"; 
            } 
    
            $this->phone = testInput(getPostVar("phone"));
            if (empty($this->phone)) {
                $this->phoneErr = "Voer een telefoonnummer in";
            }
    
            $this->salutation = testInput(getPostVar("salutation"));
            if (empty($this->salutation)) {
                $this->salutationErr = "Aanhef verplicht";
            }
    
            $this->communication = testInput(getPostVar("communication"));
            if (empty($this->communication)) {
                $this->communicationErr = "Communicatie voorkeur is verplicht";
            }
    
            $this->comment = testInput(getPostVar("comment"));
            if (empty($this->comment)) {
                $this->commentErr = "Plaats een opmerking";
            }
    
            if (empty($this->nameErr) && empty($this->emailErr) && empty($this->phoneErr) && empty($this->salutationErr) && empty($this->communicationErr) && empty($this->commentErr)) {
                $valid =true;
            }
        }
        return array('name' => $this->name, 'nameErr' => $this->nameErr, 'email' => $this->email, 'emailErr' => $this->emailErr, 'phone' => $this->phone, 'phoneErr' => $this->phoneErr, 'salutation' => $this->salutation, 'salutationErr' => $this->salutationErr, 'communication' => $this->communication, 'communicationErr' => $this->communicationErr,'comment' => $this->comment, 'commentErr' => $this->commentErr, 'valid' => $this->valid);
    }

    function validateRegister() {
        $this->username = $this->email = $this->password = $this->repeatpassword = ""; 
        $this->usernameErr = $this->emailErr = $this->passwordErr = $this->repeatpasswordErr = $this->genericErr = ""; 
        $this->valid = false; 
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $this->username = testInput(getPostVar("name")); 
            if (empty($this->username)) {  
                $this->usernameErr = "Voer een naam in";  
            }  
        
            $this->email = testInput(getPostVar("email")); 
            if (empty($this->email)) {  
                $this->emailErr = "Voer een emailadres in";  
            }  
        
            $this->password = testInput(getPostVar("password")); 
            if (empty($this->password)) {  
                $this->passwordErr = "Voer geldig wachtwoord in";  
            }  
        
            $this->repeatpassword = testInput(getPostVar("repeatpassword")); 
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

        return array(
            'valid' => $this->valid,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'repeatpassword' => $this->repeatpassword,
            'usernameErr' => $this->usernameErr,
            'emailErr' => $this->emailErr,
            'passwordErr' => $this->passwordErr,
            'repeatpasswordErr' => $this->repeatpasswordErr,
            'genericErr' => $this->genericErr
        )
    }

    function validateLogin() {
        $this->email = $this->password = "";
        $this->emailErr = $this->passwordErr = "";
        $this->username = "";
        $this->userId = 0;
        $this->genericErr= "";
        $this->valid = false;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->email = testInput(getPostVar("email"));
                if (empty($this->email)) { 
                    $this->emailErr = "Voer een emailadres in"; 
                }
            $this->password = testInput(getPostVar("password"));
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
        return array('email' => $this->email, 'emailErr' => $this->emailErr, 'password' => $this->password, 
                     'passwordErr' => $this->passwordErr, 'valid' => $this->valid, 'username' => $this->username, 'genericErr' => $this->genericErr, 'userId' => $this->userId); 
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
        $this->sessionMangerr->doLogoutUser;
    }

}