<?php
require_once('basicDoc.php');
class contactDoc extends basicDoc{

    public $name = "";
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

    protected function showHeader(){
        echo 'Contact';
    }
  
    
    protected function showContent() {
        $salutation = $this->salutation;
        $salutationErr = $this->salutationErr;
        $communication = $this->communication;
        $communicationErr = $this->communicationErr;
        
        echo '<form method="POST" action="index.php">
                <div class="salutationS">
                    <label for="salutation">Kies uw aanhef:</label>
                    <select id="salutation" name="salutation">
                        <option value="" '. ($this->salutation == "" ? "selected" : "") . '></option>
                        <option value="sir" '. ($this->salutation == "sir" ? "selected" : "") . '>Heer</option>
                        <option value="madam" '. ($this->salutation == "madam" ? "selected" : "") . '>Mevrouw</option>
                        <option value="other" '. ($this->salutation == "other" ? "selected" : "") .'>Anders</option>
                    </select>
                    <span class="error">* '.$this->model->salutationErr.'</span><br><br>
                </div>        

                <div class="invoervelden">
                    <div class="nameStyling">
                        <label for="name">Naam:</label>
                        <input type="text" id="name" name="name" value="'.$this->name.'"placeholder="Jouw naam">
                        <span class="error">* '.$this->model->nameErr.'</span><br><br>
                    </div> 
                    <div class="phoneStyling">
                        <label for="phone">Telefoonnummer:</label>
                        <input type="text" id="phone" name="phone" value="'.$this->phone.'"placeholder="Jouw telefoonnummer">
                        <span class="error">* '.$this->model->phoneErr.'</span><br><br>
                    </div>    
                    <div class= emailStyling>
                        <label for="email">E-mailadres:</label>
                        <input type="text" id="email" name="email" value="'.$this->email.'"placeholder="Jouw e-mailadres">
                        <span class="error">* '.$this->model->emailErr.'</span><br><br>
                    </div>    
                </div>

                <div class="preferenceS">
                    <label for="preferenceSentence">Communicatie voorkeur:</label>
                    <label class="telefoonnumer">
                        <input type="radio" name="communication" '.($communication =="Telefoonnummer"? "checked" : "").' value="Telefoonnummer">
                        Telefoonnummer
                    </label><br>
                    <label>
                        <input type="radio" name="communication" '.($communication =="E-mailadres" ? "checked" : "").' value="E-mailadres">
                        E-mailadres
                    </label>
                    <span class="error">* '.$this->model->communicationErr.'</span><br><br>
                </div>    

                <div class="commentContact">
                    <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Voer hier je opmerkingen in">'.$this->comment.'</textarea>
                    <span class="error">* '.$this->model->commentErr.'</span><br><br>
                    <input type="hidden" name="page" value="contact">
                    <input type="submit" value="Verzend">
                </div>    
            </form>';
        }
}