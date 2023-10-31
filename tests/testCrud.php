<?php

require_once ('../cruds/crud.php');

$crud = new Crud();

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

// Voorbeeld: Ophalen van een enkele rij
// $sql = "SELECT * FROM table_name WHERE id = :id";
// $params = array('id' => 1);
// $result = $crud->readOneRow($sql, $params);

// // Voorbeeld: Ophalen van meerdere rijen
// $sql = "SELECT * FROM table_name";
// $result = $crud->readManyRows($sql);

// // Voorbeeld: Bijwerken van een rij
// $sql = "UPDATE table_name SET column1 = :value1 WHERE id = :id";
// $params = array('value1' => 'nieuwe_waarde', 'id' => 1);
// $crud->updateRow($sql, $params);

// // Voorbeeld: Verwijderen van een rij
// $sql = "DELETE FROM table_name WHERE id = :id";
// $params = array('id' => 1);
// $crud->deleteRow($sql, $params);












