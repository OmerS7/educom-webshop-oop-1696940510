<?php

require_once ('../cruds/crud.php');

$sql = "INSERT INTO table_name (column1, column2) VALUES (:value1, :value2)";
$params = array('value1' => 'waarde1', 'value2' => 'waarde2');
$insertedId = $crud->createRow($sql, $params);

// Voorbeeld: Ophalen van een enkele rij
$sql = "SELECT * FROM table_name WHERE id = :id";
$params = array('id' => 1);
$result = $crud->readOneRow($sql, $params);

// Voorbeeld: Ophalen van meerdere rijen
$sql = "SELECT * FROM table_name";
$result = $crud->readManyRows($sql);

// Voorbeeld: Bijwerken van een rij
$sql = "UPDATE table_name SET column1 = :value1 WHERE id = :id";
$params = array('value1' => 'nieuwe_waarde', 'id' => 1);
$crud->updateRow($sql, $params);

// Voorbeeld: Verwijderen van een rij
$sql = "DELETE FROM table_name WHERE id = :id";
$params = array('id' => 1);
$crud->deleteRow($sql, $params);

?>
Zorg ervoor dat je Crud.php-bestand zich in dezelfde directory bevindt als dit testbestand.

Pas de SQL-query's aan:

Vervang table_name, column1, column2, enzovoort met de echte namen van je database en kolommen. Pas de queries aan naar wat je precies wilt doen (toevoegen, ophalen, bijwerken, verwijderen).

Voer het testbestand uit:

Open een webbrowser en navigeer naar http://localhost/test.php (vervang test.php door de naam van je testbestand als die anders is).

Dit zal de CRUD-operaties uitvoeren en eventuele resultaten of foutmeldingen weergeven.

Houd er rekening mee dat dit een eenvoudige manier is om de CRUD-functionaliteit te testen. In een echte applicatie zou je ook moeten zorgen voor beveiliging tegen SQL-injectie en andere veiligheidsmaatregelen.





