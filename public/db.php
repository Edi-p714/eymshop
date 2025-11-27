<?php
/* 
Datenbankverbindung für MAMP
--------------------------
Host: localhost
Benutzername: root
Password: roor (Standard in MAMP)
Datenbank: Eymshop
*/

$servername = "localhost";
$username = "root";
$password = "root"; // MAMP Standard-Passwort
$dbname = "Eymshop";

// Verbindung herstellen
$conn = new mysqli($servername,$username, $password, $dbname);

// Fehlerprüfung
if ($conn -> connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen:".
    $conn->connect_error);
}

// UTF-8 Unterstützung setzen (wichtig für Umlaute)
$conn->set_charset("utf8mb4");
?>