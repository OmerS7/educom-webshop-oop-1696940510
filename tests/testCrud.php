<?php

require_once ('../cruds/crud.php');

$crud = new Crud();

//crud operaties 


// (C) Voorbeeld: Toevoegen van een nieuwe rij
function addUser($username, $email, $password, $crud) {
    $sql = "INSERT INTO testTable (`username`, `email`, `password`) VALUES (:username, :email, :password)";
    $params = array('username' => $username, 'email' => $email, 'password' => $password);
    $insertedId = $crud->createRow($sql, $params);
    return $insertedId;
}

$insertedId = addUser('JAN', 'JAN@live.nl', 'jan', $crud);


// (R) Ophalen van een enkele rij
function findUserById($userId, $crud){
    $sql = "SELECT * FROM testTable WHERE id = :id";
    $params = array('id' => $userId);
    $insertedId = $crud->readOneRow($sql, $params);
    return $insertedId;
}

$user = findUserById(1, $crud);

if ($user) {
    echo "Gebruiker gevonden:<br>";
    echo "id: " . $user->id . "<br>";
    echo "Gebruikersnaam: " . $user->username . "<br>";
    echo "E-mail: " . $user->email . "<br>";
    echo "Wachtwoord: " . $user->password . "<br>";
} else {
    echo "Gebruiker niet gevonden.";
}


// (R) Ophalen van meerdere rijen
function findUsers($crud){
    $sql = "SELECT * FROM testTable";
    $result = $crud->readManyRows($sql);
    return $result;
}

$result = findUsers($crud);

if ($result) {
    foreach ($result as $row) {
        echo "Gebruiker gevonden:<br>";
        echo "id: " . $row->id . "<br>";
        echo "Gebruikersnaam: " . $row->username . "<br>";
        echo "E-mail: " . $row->email . "<br>";
        echo "Wachtwoord: " . $row->password . "<br>";
    }
} else {
    echo "Geen gebruikers gevonden.";
}


// (U) Bijwerken van een rij
function saveChangePassword($id, $password, $crud){
    $sql = "UPDATE testTable SET `password` = :password WHERE id = :id";
    $params = array('password' => $password, 'id' => $id);
    $crud->updateRow($sql, $params);
}

saveChangePassword(1, 'nieuw_wachtwoord', $crud); // Roep de functie aan met de juiste parameters



// (D) Verwijderen van een rij
function deleteUser($id, $crud){    
    $sql = "DELETE FROM testTable WHERE id = :id";
    $params = array('id' => $id); // Hier gebruiken we het meegegeven gebruikers-ID
    $crud->deleteRow($sql, $params);
}

deleteUser(1, $crud); // Verwijder de gebruiker met ID 1



// comment









