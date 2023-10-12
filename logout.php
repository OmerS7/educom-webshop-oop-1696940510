<?php
session_start(); // Start de sessie

// Vernietig de sessie
session_destroy();

// Stuur de gebruiker terug naar de homepagina
header("Location: index.php");
exit();
?>