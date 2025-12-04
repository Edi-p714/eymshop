<?php
/* 
Datenbankverbindung für MAMP
-----------------------
Host: localhost
Benutzername: root
Passwort: root (Standard in MAMP)
Datenbank: Eymshop
*/

$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = "Eymshop";
$port = 8889;


// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Fehlerprüfung
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: .$conn->connect_error");
}

// UTF-8 Unterstützung setzen (eichtig für Umlaute)
$conn->set_charset("utf8mb4");

?>