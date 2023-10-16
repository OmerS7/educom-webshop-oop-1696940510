<?php
require_once('basicDoc.php');
class passwordCDoc extends basicDoc{
    protected function showHeader() {
        echo 'Wachtwoord Wijzigen';
    }

    protected function showContent(){
        echo '<form method="POST" action="index.php">
        <label for="password">Huidige wachtwoord:</label>
        <input type="password" id ="password" name="password" value="'. $this->data ["password"].'">
        <span class="error">* '.$this->data['passwordErr'].'</span><br><br>

        <label for="changepassword">Nieuw wachtwoord:</label>
        <input type="password" name="changepassword" value="'.$this->data["changepassword"].'">
        <span class="error">* '.$this->data['changepasswordErr'].'</span><br><br>

        <label for="repeatchangepassword">Herhaal nieuw wachtwoord:</label>
        <input type="password" name="repeatchangepassword" value="'.$this->data["repeatchangepassword"].'">
        <span class="error">* '.$this->data['repeatchangepasswordErr'].'</span><br><br>

        <div class="changePasswordButton">
            <input type="hidden" name="page" value="changepassword">
            <input type="submit" value="Wijzig">
        </div>
    </form>';
    }
}    