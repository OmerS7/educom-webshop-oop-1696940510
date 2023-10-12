<?php
require_once('basicDoc.php');
class contactDoc extends basicDoc{
    protected function showHeader(){
        echo 'Contact';
    }
    /*
    require_once 'utils.php';
    require_once 'user_service.php';*/
    
    // aparte pagina van maken
    // protected function showThanks($data) {
    //     echo '<p class="thankYou"> Bedankt voor uw reactie! </p>';
    //     echo '<p class="yourInfo"> Uw ingevoerde gegegens: </p>';
    //     echo '<li> Naam: ' . $this->data['name'] . '<br>';
    //     echo '<li> Telefoonnummer: ' . $this->data['phone'] . '<br>';
    //     echo '<li> E-mail: ' . $this->data['email'] . '<br>';
    //     echo '<li> Communicatie voorkeur: ' . $this->data['communication'] . '<br>';
    //     echo '<li class="bottomText"> Bericht: ' . $this->data['comment'] . '<br>';
    // }
    
    protected function showContent() {
        //$name = $this->data['name'];
        //$nameErr = $this->data['nameErr'];
        //$email = $this->data['email'];
        //$emailErr = $this->data['emailErr'];
        //$phone = $this->data['phone'];
        //$phoneErr = $this->data['phoneErr'];
        $salutation = $this->data['salutation'];
        $salutationErr = $this->data['salutationErr'];
        $communication = $this->data['communication'];
        $communicationErr = $this->data['communicationErr'];
        //$comment = $this->data['comment'];
        //$commentErr = $this->data['commentErr'];
    
        echo '<form method="POST" action="index.php">
                <label for="salutation">Kies uw aanhef:</label>
                <select id="salutation" name="salutation">
                    <option value="" '. ($salutation == "" ? "selected" : "") . '></option>
                    <option value="sir" '. ($salutation == "sir" ? "selected" : "") . '>Heer</option>
                    <option value="madam" '. ($salutation == "madam" ? "selected" : "") . '>Mevrouw</option>
                    <option value="other" '. ($salutation == "other" ? "selected" : "") .'>Anders</option>
                </select>
                <span class="error">* '.$this->data ['salutationErr'].'</span><br><br>
    
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" value="'.$this->data['name'].'">
                <span class="error">* '.$this->data['nameErr'].'</span><br><br>
    
                <label for="phone">Telefoonnummer:</label>
                <input type="tel" id="phone" name="phone" value="'.$this->data['phone'].'">
                <span class="error">* '.$this->data['phoneErr'].'</span><br><br>
    
                <label for="email">E-mailadres:</label>
                <input type="email" id="email" name="email" value="'.$this->data['email'].'">
                <span class="error">* '.$this->data['emailErr'].'</span><br><br>
    
                <p class="preferenceSentence">Kies uw voorkeur:</p>
                <label>
                    <input type="radio" name="communication" '.($communication =="Telefoonnummer"? "checked" : "").' value="Telefoonnummer">
                    Telefoonnummer
                </label><br>
                <label>
                    <input type="radio" name="communication" '.($communication =="E-mailadres" ? "checked" : "").' value="E-mailadres">
                    E-mailadres
                </label>
                <span class="error">* '.$this->data ['communicationErr'].'</span><br><br>
                <div class="commentContact">
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Voer hier je opmerkingen in">'.$this->data['comment'].'</textarea>
                <span class="error">* '.$this->data['commentErr'].'</span><br><br>
                </div>
                <input type="hidden" name="page" value="contact">
                <input type="submit" value="Verzend">
                </form>';
        }
}