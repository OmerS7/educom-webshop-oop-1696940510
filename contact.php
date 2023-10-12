<?php

function showContactHeader(){
    echo 'Contact';
}

require_once 'utils.php';
require_once 'user_service.php';

function showContactThanks($data) {
    echo '<p class="thankYou"> Bedankt voor uw reactie! </p>';
    echo '<p class="yourInfo"> Uw ingevoerde gegegens: </p>';
    echo '<li> Naam: ' . $data['name'] . '<br>';
    echo '<li> Telefoonnummer: ' . $data['phone'] . '<br>';
    echo '<li> E-mail: ' . $data['email'] . '<br>';
    echo '<li> Communicatie voorkeur: ' . $data['communication'] . '<br>';
    echo '<li class="bottomText"> Bericht: ' . $data['comment'] . '<br>';
}

function validateContact(){    
    $name = $email = $phone = $salutation = $communication = $comment = "";
    $nameErr = $emailErr = $phoneErr = $salutationErr = $communicationErr = $commentErr = "";
    $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = testInput(getPostVar("name"));
        if (empty($name)) { 
            $nameErr = "Voer een naam in"; 
        } 

        $email = testInput(getPostVar("email"));
        if (empty($email)) { 
            $emailErr = "Voer een emailadres in"; 
        } 


        $phone = testInput(getPostVar("phone"));
        if (empty($phone)) {
            $phoneErr = "Voer een telefoonnummer in";
        }

        $salutation = testInput(getPostVar("salutation"));
        if (empty($salutation)) {
            $salutationErr = "Aanhef verplicht";
        }

        $communication = testInput(getPostVar("communication"));
        if (empty($communication)) {
            $communicationErr = "Communicatie voorkeur is verplicht";
        }

        $comment = testInput(getPostVar("comment"));
        if (empty($comment)) {
            $commentErr = "Plaats een opmerking";
        }

        if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($salutationErr) && empty($communicationErr) && empty($commentErr)) {
            $valid =true;
        }
    }
    return array('name' => $name, 'nameErr' => $nameErr, 'email' => $email, 'emailErr' => $emailErr, 'phone' => $phone, 'phoneErr' => $phoneErr, 'salutation' => $salutation, 'salutationErr' => $salutationErr, 'communication' => $communication, 'communicationErr' => $communicationErr,'comment' => $comment, 'commentErr' => $commentErr, 'valid' => $valid);
}

function showContactForm($data) {
    $name = $data['name'];
    $nameErr = $data['nameErr'];
    $email = $data['email'];
    $emailErr = $data['emailErr'];
    $phone = $data['phone'];
    $phoneErr = $data['phoneErr'];
    $salutation = $data['salutation'];
    $salutationErr = $data['salutationErr'];
    $communication = $data['communication'];
    $communicationErr = $data['communicationErr'];
    $comment = $data['comment'];
    $commentErr = $data['commentErr'];

    echo '<form method="POST" action="index.php">
            <label for="salutation">Kies uw aanhef:</label>
            <select id="salutation" name="salutation">
                <option value="" '. ($salutation == "" ? "selected" : "") . '></option>
                <option value="sir" '. ($salutation == "sir" ? "selected" : "") . '>Heer</option>
                <option value="madam" '. ($salutation == "madam" ? "selected" : "") . '>Mevrouw</option>
                <option value="other" '. ($salutation == "other" ? "selected" : "") .'>Anders</option>
            </select>
            <span class="error">* '.$data ['salutationErr'].'</span><br><br>

            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="'.$name.'">
            <span class="error">* '.$nameErr.'</span><br><br>

            <label for="phone">Telefoonnummer:</label>
            <input type="tel" id="phone" name="phone" value="'.$phone.'">
            <span class="error">* '.$phoneErr.'</span><br><br>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" value="'.$email.'">
            <span class="error">* '.$emailErr.'</span><br><br>

            <p class="preferenceSentence">Kies uw voorkeur:</p>
            <label>
                <input type="radio" name="communication" '.($communication =="Telefoonnummer"? "checked" : "").' value="Telefoonnummer">
                Telefoonnummer
            </label><br>
            <label>
                <input type="radio" name="communication" '.($communication =="E-mailadres" ? "checked" : "").' value="E-mailadres">
                E-mailadres
            </label>
            <span class="error">* '.$communicationErr.'</span><br><br>
            <div class="commentContact">
            <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Voer hier je opmerkingen in">'.$comment.'</textarea>
            <span class="error">* '.$commentErr.'</span><br><br>
            </div>
            <input type="hidden" name="page" value="contact">
            <input type="submit" value="Verzend">
            </form>';
    }