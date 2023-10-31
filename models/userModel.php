<?php
require_once('pageModel.php');

class userModel extends pageModel {
    private $userCrud;
    public $name = "";
    public $username= "";
    public $usernameErr= "";
    public $password= "";
    public $passwordErr= "";
    public $repeatpassword= "";
    public $repeatpasswordErr= "";
    public $changepassword = "";
    public $changepasswordErr = "";
    public $repeatchangepassword = "";
    public $repeatchangepasswordErr = "";
    public $email = "";
    public $phone = "";
    public $salutation = "";
    public $communication = "";
    public $comment = "";
    public $nameErr = "";
    public $emailErr = "";
    public $phoneErr = "";
    public $userPassword= "";
    public $salutationErr = "";
    public $communicationErr = "";
    public $commentErr = "";
    public $genericErr = "";
    public $user = "";
    public $userId= 0;
    public $valid = false;
    public $succes = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
        $this->userCrud = $userCrud;
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

    public function validateRegister() {
       
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
                    require_once('user_service.php');
                    if (doesEmailExist($this->email)) {
                        $this->emailErr = "Email is al geregistreerd";
                    } else {
                        $this->valid = true;
                    }
                }
                catch(Exception $e){
                    $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
                    $this->logerror("register failed: " . $e -> getMessage());
                }
            }
        }

    }

    public function validateLogin() {
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
                    require_once('user_service.php');
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
                    $this->logerror("logIn failed: " . $e -> getMessage());
                }
                
            } 
        }   
    }

    function authenticateUser(){
        require_once('db_repostitory.php');
        $user = findUserByEmail($this->email);
            if (empty($user)){
                return null;
            }   
            if ($user["password"]!=$this->password){
                return null;
            }
    }

    function validatePassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $this->password = $this->getSavePostVar("password"); 
            if (empty($this->password)) {  
                $this->passwordErr = "Voer je huidige wachtwoord in";  
            }

            $this->changepassword = $this->getSavePostVar("changepassword");
            if (empty($this->changepassword)){
                $this->changepasswordErr = "Voer een nieuw wachtwoord in";
            }

            $this->repeatchangepassword = $this->getSavePostVar("repeatchangepassword");
            if (empty($this->repeatchangepassword)){
                $this->repeatchangepasswordErr = "Herhaal het nieuwe wachtwoord";
            }

            if($this->changepassword !== $this->repeatchangepassword){
                $this->repeatchangepasswordErr = "Herhaal wachtwoord komt niet overeen";
            }
            
            if (empty($this->passwordErr) && empty($this->changepasswordErr) && empty($this->repeatchangepasswordErr)) {
                try{
                    $this->userId = getLoggedInUserId();   
                    $this->userpassword = authenticateUserPassword($this->userId,$this->password); 
                    if (empty($this->userpassword)) {
                        $this->passwordErr = "Wachtwoord is ongeldig";
                    } else {
                        $this->valid = true;
                        $this->email = $this->userpassword['email'];
                    }
                }
                catch(Exception $e){
                    $this->genericErr = "Er is een technische storing. Probeer het later nog eens";
                    $this->logerror("changepassword failed: " . $e -> getMessage());
                }
            }
        }
    }

    function authenticateUserPassword(){
        $userpassword = findUserById($id);
            if (empty($this->userpassword)){
                return null;
            }
            if ($this->userpassword["password"]!=$this->password){
                return null;
            }
    }
    
  
    function doStoreContact() {
        require_once('user_service.php');
        try{
            saveContact(
                $this->name, 
                $this->phone, 
                $this->email, 
                $this->salutation, 
                $this->communication, 
                $this->comment
            );
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("registration failed: " . $e -> getMessage());
        }
    }

   

    function doStoreUser() {
        try{
            storeUser(
            $this->email, 
            $this->username, 
            $this->password
        );
            $this->succes = true;
        }
        catch(Exception $e){
            $this->genericErr="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Registraation failed: " . $e -> getMessage());
        }
    }

    public function doLoginUser(){
        $this->sessionManager->doLoginUser($this->name, $this->userId);
        $this->genericErr="Login succesvol";
    }

    function doStorePassword(){
        try{
            storeChangePassword(
                $this->userId, 
                $this->changepassword
            );
            $this->succes = true;
            doLogoutUser(); 
        }
        catch(Exception $e){
            $data['genericErr']="Er is een technische storing. Probeer het later nog eens.";
            $this->logerror("Registraation failed: " . $e -> getMessage());
        }
    }

    function doesEmailExist(){
        $this->user = findUserByEmail($this->email);
        return !empty($this->user);
    }

    public function doLogoutUser(){
        $this->sessionManager->doLogoutUser();
    }

}